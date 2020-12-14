<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueryReply extends Model
{
    //
        //sender-message relationship
        public function sender(){
            return $this->belongsTo(User::class, 'from_id');
        }
        //receiver-message relationship
        public function receiver(){
            return $this->belongsTo(User::class, 'to_id');
        }
}
