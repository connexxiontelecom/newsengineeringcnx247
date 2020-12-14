<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeAppraisal extends Model
{
    //supervisor - appraisal relationship
    public function supervisedBy(){
        return $this->belongsTo(User::class, 'supervisor');
    }
    //employee - appraisal relationship
    public function takenBy(){
        return $this->belongsTo(User::class, 'employee');
    }
}
