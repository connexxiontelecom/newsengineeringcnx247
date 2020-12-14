<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkgroupMember extends Model
{
    /*
    * One user may have many posts
    */
    public function user(){
        return $this->belongsTo(User::class); //user_id on workgroup post table
    }
}
