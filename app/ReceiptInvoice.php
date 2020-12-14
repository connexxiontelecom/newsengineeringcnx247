<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptInvoice extends Model
{
		//
		public function getInvoices(){
			return $this->hasMany(Invoice::class, 'invoice_id');
		}
		public function getReceipts(){
			return $this->hasMany(Receipt::class, 'receipt_id');
		}
}
