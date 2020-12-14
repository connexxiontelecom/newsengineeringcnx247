<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostAttachment extends Model
{
    /*
    *An attachment may belong to one post
    */
    public function post(){
        return $this->hasMany(Post::class,'post_id');
    }

    /*
    * user-post attachment relationship
    */
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
