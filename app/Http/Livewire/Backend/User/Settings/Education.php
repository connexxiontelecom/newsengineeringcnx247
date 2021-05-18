<?php

namespace App\Http\Livewire\Backend\User\Settings;

use Livewire\Component;
use App\Education as EducationModel;
use App\Qualification;
use Auth;
class Education extends Component
{
    public $educations;
    public $education;
		public $institution, $program, $address, $start_date, $end_date, $qualification = 1;
		public $qualifications;
    public $edit_mode = 0;
    public $btn_text;
    public $education_id;
    public function render()
    {
        return view('livewire.backend.user.settings.education');
    }

    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $this->educations = EducationModel::where('tenant_id', Auth::user()->tenant_id)
                                        ->where('user_id', Auth::user()->id)
																				->get();
				$this->qualifications = Qualification::all();
        if($this->edit_mode == 0){
            $this->btn_text = "Submit";
        }else{
            $this->btn_text = "Save changes";
        }
    }

    public function editEducation($id){
        $this->edit_mode = 1;
        $this->education_id = $id;
        $this->education = EducationModel::where('tenant_id', Auth::user()->tenant_id)
                                            ->where('user_id', Auth::user()->id)
                                            ->where('id', $id)
                                            ->first();
        $this->institution = $this->education->institution;
        $this->program = $this->education['program'];
        $this->address = $this->education['address'];
        $this->start_date = $this->education['start_date'];
        $this->end_date = $this->education['end_date'];
        $this->qualification = $this->education['qualification_id'];
        $this->btn_text = "Save changes";
    }
    public function cancelEdit(){
        $this->edit_mode = 0;
        $this->program = '';
        $this->institution = '';
        $this->address = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->qualification = '';
        $this->btn_text = "Submit";
    }

    public function addNewEducation(){
        $this->validate([
            'institution'=>'required',
            'program'=>'required',
            'address'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date'
        ]);
        if($this->edit_mode == 0){
            $education = new EducationModel;
            $education->institution = $this->institution;
            $education->program = $this->program;
            $education->address = $this->address;
            $education->start_date = $this->start_date;
            $education->end_date = $this->end_date;
            $education->qualification_id = 1;
            $education->tenant_id = Auth::user()->tenant_id;
            $education->user_id = Auth::user()->id;
            $education->save();
            session()->flash("success", "<strong>Success!</strong> New education registered.");
            $this->edit_mode = 0;
            $this->institution = '';
            $this->program = '';
            $this->address = '';
            $this->start_date = '';
            $this->end_date = '';
            $this->btn_text = "Submit";
            $this->getContent();
            return back();
        }else{
            $education = EducationModel::where('tenant_id', Auth::user()->tenant_id)
                                        ->where('user_id', Auth::user()->id)
                                        ->where('id', $this->education_id)
                                        ->first();
            $education->institution = $this->institution;
            $education->program = $this->program;
            $education->address = $this->address;
            $education->start_date = $this->start_date;
            $education->end_date = $this->end_date;
            $education->qualification_id = 1;
            $education->tenant_id = Auth::user()->tenant_id;
            $education->user_id = Auth::user()->id;
            $education->save();
            session()->flash("success", "<strong>Success!</strong> Changes saved.");
            $this->edit_mode = 0;
            $this->institution = '';
            $this->program = '';
            $this->address = '';
            $this->start_date = '';
            $this->end_date = '';
            $this->btn_text = "Submit";
            $this->getContent();
            return back();
        }
    }
}
