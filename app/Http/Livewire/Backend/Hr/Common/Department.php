<?php

namespace App\Http\Livewire\Backend\Hr\Common;

use Livewire\Component;
use App\Department as DepartmentModel;
use Auth;

class Department extends Component
{
    public $departments, $department;
    public function render()
    {
        return view('livewire.backend.hr.common.department');
    }

        //mount
        public function mount(){
            $this->getContent();
        }

        //submit date format
        public function submitDepartment(){
            $this->validate([
                'department'=>'required'
            ]);
            $depart = new DepartmentModel;
            $depart->department_name = $this->department;
            $depart->tenant_id = Auth::user()->tenant_id;
            $depart->save();
            $this->department = '';
            session()->flash("success", "<strong>Success!</strong> Department registered.");
            $this->getContent();
            return redirect()->back();
        }

        public function getContent(){
            $this->departments = DepartmentModel::where('tenant_id', Auth::user()->tenant_id)
                                ->orderBy('department_name', 'ASC')->get();
        }
}
