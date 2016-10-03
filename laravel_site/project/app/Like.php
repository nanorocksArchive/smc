<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user()
    {
        return $this->belongsTo('app\User');
    }
    public function post()
    {
        return $this->belongsTo('app\Post');
    }


}
