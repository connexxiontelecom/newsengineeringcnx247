<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clocker extends Model
{
    /*
    * One user may have N clock-in/out
    */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
