<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    //user-participant relationship
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
