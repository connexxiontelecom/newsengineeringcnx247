<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cnx247stream extends Model
{
    //log-cnxstream relationship
    public function log(){
        return $this->hasMany(Cnx247StreamLog::class, 'room_id');
    }

    /*
    *user-cnx247Stream room relationship
    */
    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
