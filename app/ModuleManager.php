<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class ModuleManager extends Model
{
    //permission-module relationship
    public function permission(){
        return $this->hasMany(Permission::class, 'module');
    }
    //permission-module relationship
    public function plan(){
        return $this->belongsTo(Role::class, 'module');
    }
}
