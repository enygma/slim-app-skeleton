<?php

namespace App\Controller;
use App\Lib\Connector\Twitch;
use App\Lib\Connector\Twitter;

use App\Model\Connector;
use App\Model\User;

class SocialController extends \App\Controller\BaseController
{
    use \App\Traits\FlashMessage;

    public function index()
    {
        $twitter = new Twitter($this->container);
        $this->user->load('connectors');
        $data = [
            'connectors' => $this->user->connectors,
            'twitter_url' => $twitter->buildUrl()
        ];
        return $this->render('/social/index.php', $data);
    }

    public function twitter()
    {
        $data = [];
        return $this->render('/social/twitter.php', $data);
    }

    public function twitterCallback($request)
    {
        $data = [];
        $verifier = $request->getParam('oauth_verifier');
        $denied = $request->getParam('denied');

        if ($denied !== null) {
            $this->setFlash('Error connecting to Twitter!', 'fail');
            return $this->response->withRedirect('/error');
        }

        $twitter = new Twitter($this->container);

        $addl = $this->session->get('oauth');
        $provider = $twitter->getProvider($addl);
        $accessToken = $provider->oauth("oauth/access_token", ["oauth_verifier" => $verifier]);

        $connector = Connector::where(['user_id' => $this->user->id, 'type' => Connector::TYPE_TWITTER])->first();
        if ($connector == null) {
            $user = [
                'user_id' => $accessToken['user_id'],
                'username' => $accessToken['screen_name']
            ];
            $token = [
                'access_token' => $accessToken['oauth_token'],
                'access_token_secret' => $accessToken['oauth_token_secret']
            ];

            $connector = Connector::create([
                'user_id' => $this->user->id,
                'configuration' => json_encode([
                    'token' => $token,
                    'user' => $user
                ]),
                'type' => Connector::TYPE_TWITTER
            ]);
        }

        return $this->response->withRedirect('/user/dashboard');
        return $this->render('/social/twitter.php', $data);
    }

    public function facebook()
    {
        $data = [];
        return $this->render('/social/facebook.php', $data);
    }

    public function facebookCallback()
    {
        $data = [];
        return $this->render('/social/facebook.php', $data);
    }

    public function twitch()
    {
        $twitch = new Twitch($this->container);
        $provider = $twitch->getProvider();
        $data = [
            'url' => $provider->getAuthorizationUrl()
        ];
        return $this->render('/social/twitch.php', $data);
    }

    public function twitchCallback($request, $response)
    {
        $data = [];
        $code = $request->getParam('code');
        $twitch = new Twitch($this->container);
        $provider = $twitch->getProvider();

        $token = $provider->getAccessToken("authorization_code", [
            'code' => $code
        ]);

        $resourceOwner = $provider->getResourceOwner($token);
        $user = $this->getUser($resourceOwner);
        $config = [
            'token' => $token,
            'user' => $resourceOwner->toArray()
        ];

        $connector = Connector::where(['user_id' => $user->id])->first();

        if ($connector == null) {
            $connector = Connector::create([
                'type' => Connector::TYPE_TWITCH,
                'configuration' => json_encode($config),
                'user_id' => $user->id
            ]);
        } else {
            $connector->configuration = json_encode($config);
            $connector->save();
        }

        // Add the user to the session
        $this->session->set('user', $user);
        return $this->response->withRedirect('/user/dashboard');

        // return $this->render('/social/twitch.php', $data);
    }

    public function delete($request, $response, $args)
    {
        $connector = Connector::find($args['id']);

        // First remove any watchers and targets using the connector
        foreach ($connector->targets as $target) {
            $target->watch->delete();
            $target->delete();
        }

        $connector->delete();

        return $this->jsonSuccess('Connector removed successfully');
    }

    protected function getUser($resourceOwner)
    {
        $displayName = $resourceOwner->getDisplayName();
        $user = User::where(['username' => $displayName])->first();

        if ($user == null) {
            $bio = (empty($bio)) ? 'Player One' : $resourceOwner->getBio();

            $user = User::create([
                'username' => $displayName,
                'email' => $resourceOwner->getEmail(),
                'user_id' => $resourceOwner->getId(),
                'bio' => $bio
            ]);
        }

        return $user;
    }
}
