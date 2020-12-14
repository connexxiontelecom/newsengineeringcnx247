<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['from_id', 'to_id', 'message', 'is_read'];

    /*
    * Create relationship
    */
   /*  public function user(){
        return $this->hasMany(App\User::class, 'from_id');
    } */

    //sender-message relationship
    public function sender(){
        return $this->belongsTo(User::class, 'from_id');
    }
    //receiver-message relationship
    public function receiver(){
        return $this->belongsTo(User::class, 'to_id');
    }
}
