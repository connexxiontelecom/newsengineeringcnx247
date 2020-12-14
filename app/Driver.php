<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
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

}
