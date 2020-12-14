<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
        //category-ticket relationship
        public function tickets(){
            return $this->hasMany(Ticket::class, 'id');
        }
}
