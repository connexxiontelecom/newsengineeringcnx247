<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resignation extends Model
{
    //user to
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
