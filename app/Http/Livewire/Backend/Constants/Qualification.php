<?php

namespace App\Http\Livewire\Backend\Constants;

use Livewire\Component;
use App\Qualification as QualificationModel;
use Auth;
class Qualification extends Component
{
    public $qualifications, $qualification;

    public function render()
    {
        return view('livewire.backend.constants.qualification');
    }

    //mount
    public function mount(){
        $this->getContent();
    }

    //submit date format
    public function submitQualification(){
        $this->validate([
            'qualification'=>'required'
        ]);
        $qua = new QualificationModel;
        $qua->name = $this->qualification;
        $qua->save();
        $this->qualification = '';
        session()->flash("success", "<strong>Success!</strong> Record saved.");
        $this->getContent();
        return redirect()->back();
    }

    public function getContent(){
        $this->qualifications = QualificationModel::orderBy('name', 'ASC')->get();
    }
}
