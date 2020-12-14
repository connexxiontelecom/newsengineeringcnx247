<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalVoucher extends Model
{
    public function entryBy(){
        return $this->belongsTo(User::class, 'entry_by');
    }
}
