<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneGroup extends Model
{
    //
    public function addedBy(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
