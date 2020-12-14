<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
        //lead-client relationship
        public function lead(){
            return $this->hasOne(Lead::class, 'id');
        }

        public function addedBy(){
            return $this->belongsTo(User::class, 'owner');
        }

}
