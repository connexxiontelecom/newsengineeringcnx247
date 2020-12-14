<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function profile(){
        return $this->belongsTo(BudgetProfile::class,'budget_profile_id');
    }
}
