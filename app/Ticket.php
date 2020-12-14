<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //category-ticket relationship
    public function ticketCategory(){
        return $this->belongsTo(TicketCategory::class, 'category');
    }
}
