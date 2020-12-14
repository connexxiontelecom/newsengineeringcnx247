<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailCampaign extends Model
{
    //
    public function Tenant(){
        return $this->hasMany(Tenant::class, 'tenant_id');
    }
}
