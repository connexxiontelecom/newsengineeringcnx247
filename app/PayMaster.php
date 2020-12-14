<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayMaster extends Model
{
    //
    public function getBank(){
        return $this->belongsTo(Bank::class, 'bank_id');
		}
		//currency
		public function getCurrency(){
			return $this->belongsTo(Currency::class, 'currency_id');
	}
}
