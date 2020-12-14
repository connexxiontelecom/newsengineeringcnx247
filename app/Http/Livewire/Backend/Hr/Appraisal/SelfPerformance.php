<?php

namespace App\Http\Livewire\Backend\Hr\Appraisal;

use Livewire\Component;
use Auth;
class SelfPerformance extends Component
{
    public $question;
    public function render()
    {
        return view('livewire.backend.hr.appraisal.self-performance');
    }

    public function addQuestion(){
        $this->validate([
            'question'=>'required'
        ]);
    }
}
