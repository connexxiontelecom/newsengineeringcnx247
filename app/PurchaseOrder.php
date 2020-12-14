<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    //
    public function orderedBy(){
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function getSupplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function approvedBy(){
        return $this->belongsTo(User::class, 'approved_by');
    }
}
