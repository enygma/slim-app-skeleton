<?php

namespace App\Controller;

class IndexController extends \App\Controller\BaseController
{
    use \App\Traits\FlashMessage;

    protected function getTwitchProvider()
    {
        $provider = new \Depotwarehouse\OAuth2\Client\Twitch\Provider\Twitch([
            'clientId' => $_ENV['TWITCH_CLIENT_ID'],
            'clientSecret' => $_ENV['TWITCH_CLIENT_SECRET'],
            'redirectUri' => "http://9037c3d9.ngrok.io/social/twitchCallback"
        ]);
        return $provider;
    }

    public function index()
    {
        $provider = $this->getTwitchProvider();
        $data = [
            'url' => $provider->getAuthorizationUrl()
        ];
        return $this->render('/index/index.php', $data);
    }

    public function error()
    {
        $data = [];
        return $this->render('/index/error.php', $data);
    }
}
