<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkgroupModerator extends Model
{
    /*
    * One user may have many posts
    */
    public function user(){
        return $this->belongsTo(User::class, 'user_id'); //user_id on post table
    }
}
