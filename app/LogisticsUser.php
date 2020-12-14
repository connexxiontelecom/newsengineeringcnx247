<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class LogisticsUser extends Authenticatable
{
    //
     public function driverEmergencyContact(){
        return $this->hasMany(DriverEmergency::class, 'driver_id');
    }
    public function driverNextOfKin(){
        return $this->hasMany(DriverNextOfKin::class, 'driver_id');
    }
    public function driverGuarantor(){
        return $this->hasMany(DriverGuarantor::class, 'driver_id');
    }
    public function driverLocation(){
        return $this->belongsTo(PickupPoint::class, 'location');
    }
    public function assignedVehicle(){
        return $this->belongsTo(LogisticsVehicle::class, 'vehicle_id');
    }

}
