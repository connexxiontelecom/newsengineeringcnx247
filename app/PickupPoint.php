<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickupPoint extends Model
{
    //
    public function registeredBy(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
