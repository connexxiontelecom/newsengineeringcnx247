<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    //user-supervisor relationship
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    //department-supervisor relationship
    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }
}
