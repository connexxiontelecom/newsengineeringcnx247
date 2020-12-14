<?php

namespace App\Http\Livewire\Backend\User\Settings;

use Livewire\Component;
use App\Experience as ExperienceModel;
use Auth;

class Experience extends Component
{
    public $experiences;
    public $experience;
    public $organization_name, $job_role, $location, $start_date, $end_date, $role_description;
    public $edit_mode = 0;
    public $btn_text;
    public $experience_id;
    public function render()
    {
        return view('livewire.backend.user.settings.experience');
    }

    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $this->experiences = ExperienceModel::where('tenant_id', Auth::user()->tenant_id)
                                        ->where('user_id', Auth::user()->id)
                                        ->get();
        if($this->edit_mode == 0){
            $this->btn_text = "Submit";
        }else{
            $this->btn_text = "Save changes";
        }
    }

    public function editExperience($id){
        $this->edit_mode = 1;
        $this->experience_id = $id;
        $this->experience = ExperienceModel::where('tenant_id', Auth::user()->tenant_id)
                                            ->where('user_id', Auth::user()->id)
                                            ->where('id', $id)
                                            ->first();
        $this->organization_name = $this->experience->organisation;
        $this->job_role = $this->experience['role']; 
        $this->location = $this->experience['location']; 
        $this->start_date = $this->experience['start_date'];
        $this->end_date = $this->experience['end_date'];
        $this->role_description = $this->experience['role_description'];
        $this->btn_text = "Save changes";
    }
    public function cancelEdit(){
        $this->edit_mode = 0;
        $this->organization_name = '';
        $this->job_role = ''; 
        $this->location = ''; 
        $this->start_date = '';
        $this->end_date = '';
        $this->role_description = '';
        $this->btn_text = "Submit";
    }

    public function addNewWorkExperience(){
        $this->validate([
            'organization_name'=>'required',
            'job_role'=>'required',
            'location'=>'required',
            'start_date'=>'required|date',
            'start_date'=>'required|date',
            'role_description'=>'required',
        ]);
        if($this->edit_mode == 0){
            $experience = new ExperienceModel;
            $experience->organisation = $this->organization_name;
            $experience->role = $this->job_role; 
            $experience->location = $this->location; 
            $experience->start_date = $this->start_date;
            $experience->end_date = $this->end_date;
            $experience->role_description = $this->role_description;
            $experience->tenant_id = Auth::user()->tenant_id;
            $experience->user_id = Auth::user()->id;
            $experience->save();
            session()->flash("success", "<strong>Success!</strong> New work experience registered.");
            $this->edit_mode = 0;
            $this->organization_name = '';
            $this->job_role = ''; 
            $this->location = ''; 
            $this->start_date = '';
            $this->end_date = '';
            $this->role_description = '';
            $this->btn_text = "Submit";
            $this->getContent();
            return back();
        }else{
            $experience = ExperienceModel::where('tenant_id', Auth::user()->tenant_id)
                                        ->where('user_id', Auth::user()->id)
                                        ->where('id', $this->experience_id)
                                        ->first();
            $experience->organisation = $this->organization_name;
            $experience->role = $this->job_role; 
            $experience->location = $this->location; 
            $experience->start_date = $this->start_date;
            $experience->end_date = $this->end_date;
            $experience->role_description = $this->role_description;
            $experience->save();
            session()->flash("success", "<strong>Success!</strong> Changes saved.");
            $this->edit_mode = 0;
            $this->organization_name = '';
            $this->job_role = ''; 
            $this->location = ''; 
            $this->start_date = '';
            $this->end_date = '';
            $this->role_description = '';
            $this->btn_text = "Submit";
            $this->getContent();
            return back();
        }
    }
}
