<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionQuantitative extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class, 'added_by');
    }
    public function jobRole(){
        return $this->hasMany(JobRole::class,'role_id');
    }
}
