<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //product-category relationship
    public function category(){
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    //user-product relationship
    public function user(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
