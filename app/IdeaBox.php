<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdeaBox extends Model
{
    //
    public function repliedBy(){
        return $this->belongsTo(User::class, 'replied_by');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
