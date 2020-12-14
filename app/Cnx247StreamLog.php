<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cnx247StreamLog extends Model
{
    //user-cnx247stream-log relationship
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
