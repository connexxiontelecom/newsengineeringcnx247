<?php

namespace App\Http\Livewire\Backend\Constants;

use Livewire\Component;
use App\Industry as IndustryModel;
use Auth;
class Industry extends Component
{
    public $industry, $industries;

    public function render()
    {
        return view('livewire.backend.constants.industry');
    }

    //mount
    public function mount(){
        $this->getContent();
    }

    //submit date format
    public function submitIndustry(){
        $this->validate([
            'industry'=>'required'
        ]);
        $indus = new IndustryModel;
        $indus->industry = $this->industry;
        $indus->save();
        $this->industry = '';
        session()->flash("success", "<strong>Success!</strong> Industry registered.");
        $this->getContent();
        return redirect()->back();
    }

    public function getContent(){
        $this->industries = IndustryModel::orderBy('industry', 'ASC')->get();
    }
}
