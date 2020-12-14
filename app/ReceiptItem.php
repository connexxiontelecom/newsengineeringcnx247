<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptItem extends Model
{
		//
		public function getInvoiceDescription(){
			return $this->hasMany(InvoiceItem::class, 'invoice_id');
		}
}
