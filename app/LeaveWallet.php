<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveWallet extends Model
{
    //Leavewallet - user relationship
     public function user(){
        return $this->belongsTo(User::class); //user_id on Leavewallet table
    } 

    
}
