<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueryEmployee extends Model
{
    //user-query relationship
    public function queriedEmployee(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function issuedBy(){
        return $this->belongsTo(User::class, 'queried_by');
    }
}
