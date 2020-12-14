<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostSubmission extends Model
{
    //

    public function getPostAttachment(){
        return $this->hasMany(PostSubmissionAttachment::class, 'post_id', 'post_id');
    }

    public function getPost(){
        return $this->hasMany(Post::class, 'post_id');
    }
}
