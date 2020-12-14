<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkgroupInvite extends Model
{
    //workgroup - workgroup invite relationship
    public function workgroupDetails(){
        return $this->belongsTo(Workgroup::class, 'workgroup_id');
    }
    //workgroup - workgroup invite relationship
    public function invitedBy(){
        return $this->belongsTo(User::class, 'invited_by');
    }
}
