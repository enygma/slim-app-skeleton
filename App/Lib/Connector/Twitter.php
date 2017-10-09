<?php

namespace App\Lib\Connector;
use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter extends \App\Lib\Connector
{
    public function getProvider(array $addl = [])
    {
        if (!empty($addl)) {
            $provider = new TwitterOAuth(
                $_ENV['TWITTER_API_KEY'], $_ENV['TWITTER_API_SECRET'],
                $addl['token'], $addl['secret']
            );
        } else {
            $provider = new TwitterOAuth($_ENV['TWITTER_API_KEY'], $_ENV['TWITTER_API_SECRET']);
        }

        return $provider;
    }

    public function buildUrl()
    {
        $provider = $this->getProvider();
        $requestToken = $provider->oauth(
            'oauth/request_token',
            ['oauth_callback' => $_ENV['TWITTER_API_CALLBACK']]
        );
        // Save these to the session
        $this->getContainer()->session->set('oauth', [
            'token' => $requestToken['oauth_token'],
            'secret' => $requestToken['oauth_token_secret']
        ]);

        $url = $provider->url('oauth/authorize', ['oauth_token' => $requestToken['oauth_token']]);

        return $url;
    }

    public function post($message)
    {
        $config = $this->getConfig();
        $connection = $this->getProvider([
            'token' => $config->token->access_token,
            'secret' => $config->token->access_token_secret
        ]);
        
        $status = $connection->post("statuses/update", ["status" => $message]);
        return $status;
    }
}
