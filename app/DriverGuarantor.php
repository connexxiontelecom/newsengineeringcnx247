<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverGuarantor extends Model
{
    //
    public function guarantorRelationship(){
        return $this->belongsTo(Relationship::class, 'relationship');
    }
}
