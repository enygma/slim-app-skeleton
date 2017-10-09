<?php

namespace App\Lib\Connector;

class Twitch extends \App\Lib\Connector
{
    public function getProvider(array $addl = [])
    {
        $provider = new \Depotwarehouse\OAuth2\Client\Twitch\Provider\Twitch([
            'clientId' => $_ENV['TWITCH_CLIENT_ID'],
            'clientSecret' => $_ENV['TWITCH_CLIENT_SECRET'],
            'redirectUri' => $_ENV['SITE_URL']."/social/twitchCallback"
        ]);
        return $provider;
    }

    public function post($message)
    {
        // Nothing to see
    }
}
