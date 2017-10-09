<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    protected $fillable = ['watch_id', 'start_time'];
    protected $table = 'live';
}
