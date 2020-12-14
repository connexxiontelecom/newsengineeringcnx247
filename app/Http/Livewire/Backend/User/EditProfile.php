<?php

namespace App\Http\Livewire\Backend\User;

use Livewire\Component;
use Auth;
use App\User;
use App\Department;
class EditProfile extends Component
{
    #Personal info public properties
    public $first_name, $surname, $email, $mobile, $gender,
    $position, $hire_date, $confirm_date, $birth_date,
    $department, $address, $employee_id;
    public $marital_status;
    public $departments;

    public function render()
    {
        return view('livewire.backend.user.edit-profile');
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
        $this->gender = Auth::user()->gender ?? '';
        $this->marital_status = Auth::user()->marital_status ?? '';
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
            $user->marital_status = $this->marital_status;
            $user->save();
            session()->flash("success", "<strong>Success!</strong> Changes saved.");
            $this->setProperties();
            return redirect()->route('my-profile');
    }
}
