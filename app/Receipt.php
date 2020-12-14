<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
        //Client-receipt relationship
        public function client(){
            return $this->belongsTo(Client::class, 'client_id');
        }

        //invoiceItem-invoice relationship
        public function receiptItem(){
            return $this->hasMany(ReceiptItem::class, 'receipt_id');
        }

        //invoice-detail relationship
        public function getReceiptItems(){
            return $this->hasMany(ReceiptItem::class, 'invoice_id');
        }

        //invoice-client
        public function clients(){
            return $this->hasMany(Client::class, 'client_id');
        }

        public function converter(){
            return $this->belongsTo(User::class, 'issued_by');
				}

				//currency
				public function getCurrency(){
					return $this->belongsTo(Currency::class, 'currency_id');
			}
}
