<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillMaster extends Model
{
    public function getVendor(){
        return $this->belongsTo(Supplier::class, 'vendor_id');
    }

    public function issuedBy(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function billedTo(){
        return $this->belongsTo(Supplier::class, 'billed_to');
    }

    public function billItems(){
        return $this->hasMany(BillDetail::class, 'bill_id');
		}
		//currency
		public function getCurrency(){
			return $this->belongsTo(Currency::class, 'currency_id');
	}
}
