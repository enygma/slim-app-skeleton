<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Connector extends Model
{
    const TYPE_TWITCH = 'twitch';
    const TYPE_TWITTER = 'twitter';
    const TYPE_FACEBOOK = 'facebook';

    protected $fillable = ['user_id', 'configuration', 'type'];
    protected $table = 'connector';

    public function getIdentifier()
    {
        $meta = json_decode($this->configuration);
        return $meta->user->username;
    }

    public function targets()
    {
        return $this->hasMany('\App\Model\Target', 'connector_id', 'id');
    }
}
