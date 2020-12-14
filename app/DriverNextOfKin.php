<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverNextOfKin extends Model
{
    //
    public function nextOfKinRelationship(){
        return $this->belongsTo(Relationship::class, 'relationship');
    }
}
