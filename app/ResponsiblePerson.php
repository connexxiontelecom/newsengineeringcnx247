<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ResponsiblePerson extends Model
{
    use Notifiable;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
