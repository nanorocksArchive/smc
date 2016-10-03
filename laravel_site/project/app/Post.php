<?php

namespace App;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $table='posts';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public  function likes()
    {
        return $this->hasMany('App\Like');
    }
}
