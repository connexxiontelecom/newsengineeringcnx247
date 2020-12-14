<?php

namespace App\Http\Livewire\Backend\Hr\Common;

use Livewire\Component;
use App\Supervisor as SupervisorModel;
use App\Department;
use App\User;
use Auth;

class Supervisors extends Component
{
    public $supervisor, $employees, $supervisors, $departments, $department, $employee;
    public $supervisorId = 0;
    public function render()
    {
        return view('livewire.backend.hr.common.supervisors');
    }

    //mount
    public function mount(){
        $this->getContent();
    }

    //submit date format
    public function submitSupervisor(){
        $this->validate([
            'department'=>'required',
            'supervisor'=>'required'
        ]);
        #Check if there's an existing supervisor
        $active_supervisor = SupervisorModel::where('tenant_id', Auth::user()->tenant_id)
                             ->where('department_id', $this->department)
                             ->first();
            if($this->supervisorId != 0){
                    $sup = SupervisorModel::where('user_id', $this->supervisorId)->first();
                    $sup->department_id = $this->department;
                    $sup->user_id = $this->supervisor;
                    $sup->tenant_id = Auth::user()->tenant_id;
                    $sup->save();
                    session()->flash("success", "<strong>Success!</strong> Changes saved.");
                    $this->getContent();
                    return redirect()->back();
            }else{
                if(!empty($active_supervisor) ){
                    session()->flash("error", "<strong>Oops!</strong> There's an existing supervisor for this department.");
                }else{
                    $sup = new SupervisorModel;
                    $sup->department_id = $this->department;
                    $sup->user_id = $this->supervisor;
                    $sup->tenant_id = Auth::user()->tenant_id;
                    $sup->save();
                    session()->flash("success", "<strong>Success!</strong> Supervisor assigned");
                    $this->getContent();
                    return redirect()->back();
                }
            }
    }

    public function getContent(){
        $this->departments = Department::where('tenant_id', Auth::user()->tenant_id)
                            ->orderBy('department_name', 'ASC')->get();
        $this->employees = User::where('tenant_id', Auth::user()->tenant_id)->get();
        $this->supervisors = SupervisorModel::where('tenant_id', Auth::user()->tenant_id)->get();
    }

    public function editSupervisor($id){
        $this->supervisorId = $id;
    }

}
