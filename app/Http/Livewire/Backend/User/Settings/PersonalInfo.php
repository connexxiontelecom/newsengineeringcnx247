<?php

namespace App\Http\Livewire\Backend\User\Settings;

use Livewire\Component;
use App\User;
use App\Department;
use App\MaritalStatus;
use Auth;
class PersonalInfo extends Component
{
        #Personal info public properties
        public $first_name, $surname, $email, $mobile, $gender,
        $position, $hire_date, $confirm_date, $birth_date,
        $department, $address, $employee_id, $start_date;
        public $departments;
        public $marital_status;
        public $marital_statuses;

    public function render()
    {
        return view('livewire.backend.user.settings.personal-info');
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
        $this->start_date = Auth::user()->start_date ?? '';
        $this->department = Auth::user()->department_id ?? '';
        $this->employee_id = Auth::user()->employee_id ?? '';
        $this->address = Auth::user()->address ?? '';
        $this->gender = Auth::user()->gender ?? 1;
        $this->marital_status = Auth::user()->marital_status ?? 2;
        $this->departments = Department::where('tenant_id', Auth::user()->tenant_id)->get();

        $this->marital_statuses = MaritalStatus::all();
    }
        /*
    * Update profile event listener
    */
    public function updateProfile(){
        $messages = [
            'required' => 'The :attribute is mandatory',
            'mobile.regex' => 'The phone number must be in E.164 format(+234...)'
        ];

/*         $this->validate(
                [

                'mobile' => 'required|regex:/^\+[1-9]\d{1,14}$/'
            ], $messages
        ); */

        $this->validate([
            'first_name'=>'required',
            'surname'=>'required',
            'mobile'=>'required|regex:/^\+[1-9]\d{1,14}$/',
            'position'=>'required',
            'hire_date'=>'required',
            'confirm_date'=>'required',
            'birth_date'=>'required',
            'department'=>'required',
            'address'=>'required',
            'email'=>'required|email'
        ], $messages);
        $user = User::find(Auth::user()->id);
        $user->first_name = $this->first_name;
        $user->surname = $this->surname;
        $user->mobile = $this->mobile;
        $user->position = $this->position;
        $user->hire_date = $this->hire_date;
        $user->confirm_date = $this->confirm_date;
        $user->start_date = $this->start_date;
        $user->birth_date = $this->birth_date;
        $user->department_id = $this->department;
        $user->address = $this->address;
        $user->email = $this->email;
        $user->gender = $this->gender ?? 1;
        $user->marital_status = $this->marital_status;
        $user->save();
        session()->flash("success", "<strong>Success!</strong> Changes saved.");
        $this->setProperties();
        return redirect()->route('my-profile');
}
}
