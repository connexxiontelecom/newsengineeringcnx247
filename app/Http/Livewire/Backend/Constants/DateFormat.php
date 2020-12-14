<?php

namespace App\Http\Livewire\Backend\Constants;

use Livewire\Component;
use App\DefaultDateFormat;
use Auth;

class DateFormat extends Component
{
    public $date_format, $formats;
    public function render()
    {
        return view('livewire.backend.constants.date-format');
    }

    //mount
    public function mount(){
        $this->getContent();
    }
    //submit date format
    public function submitDateFormat(){
        $this->validate([
            'date_format'=>'required'
        ]);
        $format = new DefaultDateFormat;
        $format->format = $this->date_format;
        $format->save();
        $this->date_format = '';
        session()->flash("success", "<strong>Success!</strong> Date format registered.");
        $this->getContent();
        return redirect()->back();
    }

    public function getContent(){
        $this->formats = DefaultDateFormat::all();
    }
}
