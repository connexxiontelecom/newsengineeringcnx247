<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerQuantitative extends Model
{
    //
    public function questionQuantitative(){
        return $this->belongsTo(QuestionQuantitative::class, 'question_id');
    }
}
