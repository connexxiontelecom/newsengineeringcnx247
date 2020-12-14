<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workgroup extends Model
{
    //One workgroup may have N number of users
    public function member(){
        return $this->hasMany(WorkgroupMember::class, 'workgroup_id');
    }

    /*
    *user-workgroup relationship
    */
    public function workgroupOwner(){
        return $this->belongsTo(User::class, 'owner');
    }
    /*
    * Workgroup moderators
    */
    public function workgroupModerators(){
        return $this->hasMany(WorkgroupModerator::class, 'workgroup_id');
    }
    /*
    * Workgroup posts
    */
    public function workgroupPosts(){
        return $this->hasMany(WorkgroupPost::class, 'group_id');
    }

    /*
    * One workgroup post may have N number of comments
    */
    public function workgroupAttachments(){
        return $this->hasMany(WorkgroupAttachment::class, 'workgroup_id');
    }

    /*
    * One workgroup post may have N number of comments
    */
    public function workgroupComments(){
        return $this->hasMany(WorkgroupComment::class, 'workgroup_id');
    }


}
