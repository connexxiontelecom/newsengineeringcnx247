<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobRole extends Model
{
    //department-job-role relationship
    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }


}
