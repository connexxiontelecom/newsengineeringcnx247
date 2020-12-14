<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerSelf extends Model
{
    //
    public function questionSelf(){
        return $this->belongsTo(QuestionSelf::class, 'question_id');
    }
}
