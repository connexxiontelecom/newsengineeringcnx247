<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
        //Client-invoice relationship
        public function client(){
            return $this->belongsTo(Client::class, 'client_id');
        }

        //invoiceItem-invoice relationship
        public function invoiceItem(){
            return $this->hasMany(InvoiceItem::class, 'invoice_id');
        }
        //invoiceItem-invoice relationship
        public function productDescription(){
            return $this->hasMany(Product::class, 'invoice_id');
        }

        //invoice-client
        public function clients(){
            return $this->hasMany(Client::class, 'client_id');
        }

        //top-performers-invoice relationship
        public function converter(){
            return $this->belongsTo(User::class, 'issued_by');
        }
        //currency
        public function getCurrency(){
            return $this->belongsTo(Currency::class, 'currency_id');
        }
}
