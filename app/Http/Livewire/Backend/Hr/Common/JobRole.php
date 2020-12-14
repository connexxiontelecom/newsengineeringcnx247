<?php

namespace App\Http\Livewire\Backend\Hr\Common;

use Livewire\Component;
use App\Department;
use App\User;
use App\JobRole as JobRoleModel;
use Auth;
class JobRole extends Component
{
    public $departments, $department, $job_role, $role_description;
    public $job_roles;
    public function render()
    {
        return view('livewire.backend.hr.common.job-role');
    }
    //mount
    public function mount(){
        $this->getContent();
    }

    //submit submitJobRole
    public function submitJobRole(){
        $this->validate([
            'department'=>'required',
            'role_description'=>'required',
            'job_role'=>'required'
        ]);

        $sup = new JobRoleModel;
        $sup->department_id = $this->department;
        $sup->role_name = $this->job_role;
        $sup->role_description = $this->role_description;
        $sup->tenant_id = Auth::user()->tenant_id;
        $sup->save();
        session()->flash("success", "<strong>Success!</strong> Record saved.");
        $this->getContent();
        return redirect()->back();
        }

        public function getContent(){
            $this->departments = Department::where('tenant_id', Auth::user()->tenant_id)
                                ->orderBy('department_name', 'ASC')->get();
            $this->job_roles = JobRoleModel::where('tenant_id', Auth::user()->tenant_id)->get();
        }
}
