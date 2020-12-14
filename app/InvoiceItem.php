<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    //
    public function getProduct(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
