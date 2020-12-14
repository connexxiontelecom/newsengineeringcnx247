<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    //client-lead relationship
    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }
}
