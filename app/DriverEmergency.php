<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverEmergency extends Model
{
    //

    public function emergencyRelationship(){
        return $this->belongsTo(Relationship::class, 'relationship');
    }
}
