<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantBankDetail extends Model
{
    //bank-details - tenant relationship
    public function tenantAccount(){
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
