<?php

namespace App\Http\Livewire\Backend\User;

use Livewire\Component;
use Auth;
use App\User;
use App\Experience;
use App\Education;
use App\Resignation;
use App\Clocker;
use App\Department;

class MyProfile extends Component
{
    public $ex_index = 1;
    public $ed_index = 1;
    #Personal info public properties
    public $first_name, $surname, $email, $mobile, $gender,
    $position, $hire_date, $confirm_date, $birth_date,
    $department, $address, $employee_id;

    #Work experience public properties
    public $organisation, $role, $location, $start_date, $end_date, $job_description;
    public $experiences = [];

    #Education public properties
    public $program_ended, $program_started, $institution, $program, $qualification;
    public $education = [];
    #Other parameters
    public $resignations, $attendance;
    public $departments;
    public function render()
    {
        return view('livewire.backend.user.my-profile');
    }

    public function mount(){
        if(!Auth::check()){
            return redirect()->route('signin');
        }else{
            $this->setProperties();
        }
    }

    /*
    * Initialize properties
    */
    public function setProperties(){
        #Initialize default values
        $this->email = Auth::user()->email;
        $this->first_name = Auth::user()->first_name ?? '';
        $this->surname = Auth::user()->surname ?? '';
        $this->mobile = Auth::user()->mobile ?? '';
        $this->position = Auth::user()->position ?? '';
        $this->hire_date = Auth::user()->hire_date ?? '';
        $this->confirm_date = Auth::user()->confirm_date ?? '';
        $this->birth_date = Auth::user()->birth_date ?? '';
        $this->department = Auth::user()->department ?? '';
        $this->employee_id = Auth::user()->employee_id ?? '';
        $this->address = Auth::user()->address ?? '';
        $this->resignations = Resignation::where('user_id', Auth::user()->id)->where('tenant_id',Auth::user()->tenant_id)->get();
        $this->attendance = Clocker::where('user_id', Auth::user()->id)->where('tenant_id',Auth::user()->tenant_id)->get();

        $this->experiences = Experience::where('user_id', Auth::user()->id)->where('tenant_id',Auth::user()->tenant_id)->latest()->get();
        $this->education = Education::where('user_id', Auth::user()->id)->where('tenant_id',Auth::user()->tenant_id)->latest()->get();
        $this->departments = Department::where('tenant_id', Auth::user()->tenant_id)->get();
    }


    /*
    * Update profile event listener
    */
    public function updateProfile(){
            $this->validate([
                'first_name'=>'required',
                'surname'=>'required',
                'mobile'=>'required',
                'position'=>'required',
                'hire_date'=>'required',
                'confirm_date'=>'required',
                'birth_date'=>'required',
                'department'=>'required',
                'address'=>'required',
                'email'=>'required|email'
            ]);
            $user = User::find(Auth::user()->id);
            $user->first_name = $this->first_name;
            $user->surname = $this->surname;
            $user->mobile = $this->mobile;
            $user->position = $this->position;
            $user->hire_date = $this->hire_date;
            $user->confirm_date = $this->confirm_date;
            $user->department_id = $this->department;
            $user->address = $this->address;
            $user->email = $this->email;
            $user->gender = $this->gender;
            $user->save();
            session()->flash("profile_update", "<strong>Success!</strong> Changes saved.");
            $this->setProperties();
    }

    /*
    * Add New work experience
    */
    public function addWorkExperience(){
        $this->validate([
            'organisation'=>'required',
            'role'=>'required',
            'location'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'job_description'=>'required'
        ]);
        $exp = new Experience;
        $exp->user_id = Auth::user()->id;
        $exp->organisation = $this->organisation;
        $exp->role = $this->role;
        $exp->location = $this->location;
        $exp->start_date = $this->start_date;
        $exp->end_date = $this->end_date;
        $exp->role_description = $this->job_description;
        $exp->tenant_id = Auth::user()->tenant_id;
        $exp->save();
        session()->flash("work_experience", "<strong>Success!</strong> New work experience saved. You can add more.");
        //$this->setProperties();
    }

    /*
    * Add education
    */
    public function addEducation(){
        $this->validate([
            'program_ended'=>'required',
            'program_started'=>'required',
            'program'=>'required',
            'qualification'=>'required',
            'institution'=>'required'
        ]);
        $edu = new Education;
        $edu->user_id = Auth::user()->id;
        $edu->institution = $this->institution;
        $edu->qualification = $this->qualification;
        $edu->program = $this->program;
        $edu->start_date = $this->program_started;
        $edu->end_date = $this->program_ended;
        $edu->save();
        session()->flash("eeducation", "<strong>Success!</strong> Record saved.");
        $this->setProperties();
    }
}
