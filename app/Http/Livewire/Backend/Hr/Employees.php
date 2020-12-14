<?php

namespace App\Http\Livewire\Backend\Hr;

use Livewire\Component;
use Livewire\WithPagination;
use App\User;
use App\Resignation;
use App\Department;
use Auth;

class Employees extends Component
{
    use WithPagination;
   //public $employees;
    public $confirm_from, $confirm_to;
    public $hire_from, $hire_to;
    public $department;
    public $terminated;
    public $resigned;

    public function mount(){
        $this->getEmployees();
    }
    public function render()
    {
        return view('livewire.backend.hr.employees',
        [
            'departments'=>Department::where('tenant_id', Auth::user()->tenant_id)->orderBy('department_name', 'ASC')->get(),
            'employees' => User::where('tenant_id',Auth::user()->tenant_id)->orderBy('first_name', 'ASC')->paginate(8)
            ]);
    }

    /*
    * Get list of all employees
    */
    public function getEmployees(){
        //$this->employees = User::where('tenant_id',Auth::user()->tenant_id)->orderBy('first_name', 'ASC')->paginate(8);
        $this->terminated = User::where('tenant_id',Auth::user()->tenant_id)->where('account_status', 2)->get();
        $this->resigned = Resignation::where('tenant_id',Auth::user()->tenant_id)->where('status', 'approved')->get();

    }

    public function sortEmployeeByConfirmDate(){
        $this->validate([
            'confirm_from'=>'required',
            'confirm_to'=>'required'
        ]);
        $this->employees = User::where('tenant_id',Auth::user()->tenant_id)
                                ->whereBetween('confirm_date', [$this->confirm_from, $this->confirm_to])
                                ->orderBy('first_name', 'ASC')->get();

    }
    public function sortEmployeeByHire(){
        $this->validate([
            'hire_from'=>'required',
            'hire_to'=>'required'
        ]);
        $this->employees = User::where('tenant_id',Auth::user()->tenant_id)
        ->whereBetween('hire_date', [$this->hire_from, $this->hire_to])
        ->orderBy('first_name', 'ASC')->get();

    }
    public function sortByDepartment(){
        $this->validate([
            'department'=>'required'
        ]);
        $this->employees = User::where('tenant_id',Auth::user()->tenant_id)
        ->where('department_id', $this->department)
        ->orderBy('first_name', 'ASC')->get();

    }
}
