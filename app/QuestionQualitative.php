<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionQualitative extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
