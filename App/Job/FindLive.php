<?php

namespace App\Job;

use App\Model\Connector;
use App\Model\Watch;
use App\Model\Target;
use App\Model\Live;

class FindLive extends \App\Job
{
    public function execute()
    {
        $targets = Target::all();

        foreach ($targets as $target) {
            // Get the connector, username and the feed info
            $connector = $target->connector;
            $username = $target->watch->username;
            $info = $this->getTwitchInfo($username);

            if (isset($info['stream']) && $info['stream'] !== null) {
                $message = $this->buildMessage($info);

                $connectorNs = '\\App\\Lib\\Connector\\'.ucwords($connector->type);
                if (!class_exists($connectorNs)) {
                    throw new \Exception('Invalid connector type: '.$connector->type);
                }
                $connectorInstance = new $connectorNs($this->getContainer(), $connector->configuration);

                $this->log("Posting to Twitter account: ".$connector->getIdentifier());
                $connectorInstance->post($message);

                list($date, $time) = explode('T', $info['stream']['created_at']);

                // Make a new "live" entry
                Live::create([
                    'watch_id' => $target->watch->id,
                    'start_time' => 
                ]);

            } elseif($info['stream'] == null) {
                $this->log("User ".$username." is not live");
            }
        }
    }

    protected function getTwitchInfo($username)
    {
        $this->log('Finding feed data for: '.$username);

        $twitchApi = new \TwitchApi\TwitchApi(
            ['client_id' => $_ENV['TWITCH_CLIENT_ID']]
        );

        $user = $twitchApi->getUserByUsername($username);
        $user = $user['users'][0];
        $stream = $twitchApi->getStreamByUser($user['_id'], 'live');

        return $stream;
    }

    protected function buildMessage($stream)
    {
        $channel = $stream['stream']['channel'];

        $title = $channel['status'];
        $url = $channel['url'];
        $name = $channel['name'];

        $message = 'Live now! '.$name.': '.$title.' '.$url;

        return $message;
    }
}
