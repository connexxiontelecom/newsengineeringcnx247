<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandlordTenantConversation extends Model
{
    //user- tenant-conversation relationship
    public function user(){
        return $this->belongsTo(User::class, 'sender_id');
    }
}
