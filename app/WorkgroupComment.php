<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkgroupComment extends Model
{
        /*
    * A comment belongs to a user
    */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
