<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverLog extends Model
{
    //

    public function driver(){
        return $this->belongsTo(LogisticsUser::class, 'driver_id');
    }
}
