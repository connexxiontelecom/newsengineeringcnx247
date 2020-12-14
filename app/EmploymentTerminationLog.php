<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmploymentTerminationLog extends Model
{
    //
    public function terminatedBy(){
        return $this->belongsTo(User::class, 'terminated_by');
    }
    public function terminatedEmployee(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
