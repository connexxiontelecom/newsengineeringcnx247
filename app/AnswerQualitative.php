<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerQualitative extends Model
{
    //
    public function questionQualitative(){
        return $this->belongsTo(QuestionQualitative::class, 'question_id');
    }
}
