<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    //project-milestone relationship
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
