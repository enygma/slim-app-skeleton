<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $fillable = ['connector_id', 'watch_id'];
    protected $table = 'target';

    public function connector()
    {
        return $this->hasOne('\App\Model\Connector', 'id', 'connector_id');
    }

    public function watch()
    {
        return $this->hasOne('\App\Model\Watch', 'id', 'watch_id');
    }
}
