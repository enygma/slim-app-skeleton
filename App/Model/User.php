<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['username', 'user_id', 'email', 'bio'];
    protected $table = 'users';

    public function connectors()
    {
        return $this->hasMany('\App\Model\Connector');
    }
}
