<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    //
    public function billService(){
        return $this->belongsTo(Service::class, 'service_id');
    }
}
