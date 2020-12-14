<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionSelf extends Model
{
    //user-self-assessment relationship 
    public function user(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
