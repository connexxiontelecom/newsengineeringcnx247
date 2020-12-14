<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkgroupPost extends Model
{
    //user - workgroup-post relationship
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }



    /*
    * One workgroup post may have N number of likes
    */
    public function workgroupDetails(){
        return $this->hasMany(Workgroup::class, 'id');
    }

    /*
    * One workgroup post may have N number of likes
    */
    public function workgroupLikes(){
        return $this->hasMany(WorkgroupLike::class, 'post_id');
    }

    /*
    * One workgroup post may have N number of comments
    */
    public function workgroupComments(){
        return $this->hasMany(WorkgroupComment::class, 'post_id');
    }
}
