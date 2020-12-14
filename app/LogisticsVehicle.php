<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogisticsVehicle extends Model
{
    //
    public function addedBy(){
        return $this->belongsTo(User::class, 'added_by');
    }
    public function assignedTo(){
        return $this->belongsTo(LogisticsUser::class, 'assigned_to');
    }
    public function vehicleLog(){
        return $this->hasMany(LogisticsVehicleAssignmentLog::class, 'vehicle_id');
    }
}
