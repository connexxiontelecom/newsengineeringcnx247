<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Membership extends Model
{
    //tenant-membership relationship
    public function tenant(){
        return $this->belongsTo(Tenant::class, 'tenant_id', 'tenant_id');
    }
    //role or plan - plan-features relationship
    public function planName(){
        return $this->belongsTo(Role::class, 'plan_id');
    }
}
