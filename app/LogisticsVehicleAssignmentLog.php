<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogisticsVehicleAssignmentLog extends Model
{
    //
    public function assignedTo(){
        return $this->belongsTo(LogisticsUser::class, 'driver_id');
    }
    public function assignedBy(){
        return $this->belongsTo(User::class, 'assigned_by');
    }
    public function vehicelInfo(){
        return $this->belongsTo(LogisticsVehicle::class, 'vehicle_id');
    }
}
