<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
