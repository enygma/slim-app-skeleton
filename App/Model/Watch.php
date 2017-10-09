<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    protected $fillable = ['user_id', 'username'];
    protected $table = 'watch';

    public function targets()
    {
        return $this->hasMany('\App\Model\Target', 'watch_id', 'id');
    }
}
