<?php

namespace App\Http\Livewire\Backend\Hr;

use Livewire\Component;
use App\LeaveType as LeaveTypeModel;
use Auth;

class LeaveType extends Component
{
    public $leave_name, $leave_duration;
    public $action;
    public $leave_id;
    public function render()
    {
        $leaves = LeaveTypeModel::orderBy('leave_name', 'DESC')->where('tenant_id',Auth::user()->tenant_id)->get();
        return view('livewire.backend.hr.leave-type', ['leaves'=>$leaves]);
    }

    /*
    * Leave type submission
    */
    public function submitLeaveType(){
        $this->validate([
            'leave_name'=>'required|unique:leave_types',
            'leave_duration'=>'required'
        ]);
        $type = new LeaveTypeModel;
        $type->leave_name = $this->leave_name;
        $type->duration = $this->leave_duration;
        $type->tenant_id = Auth::user()->tenant_id;
        $type->save();
        session()->flash("success", "<strong>Success! </strong> New leave type registered.");
        $this->leave_name = '';
        $this->leave_duration = '';
        return redirect()->back();
    }

    public function editLeaveType($id){
        $this->action = 'edit';
        $leave = LeaveTypeModel::where('id',$id)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($leave) ){
            $this->leave_name = $leave->leave_name;
            $this->leave_duration = $leave->duration;
            $this->leave_id = $leave->id;
        }
    }

    public function cancelEdit(){
        $this->action = 'cancelled';
        $this->leave_name = '';
        $this->leave_duration = '';
    }
    public function saveLeaveTypeChanges(){
        $this->validate([
            'leave_name'=>'required|unique:leave_types',
            'leave_duration'=>'required'
        ]);
        $type = LeaveTypeModel::where('id', $this->leave_id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $type->leave_name = $this->leave_name;
        $type->duration = $this->leave_duration;
        $type->tenant_id = Auth::user()->tenant_id;
        $type->save();
        session()->flash("success", "<strong>Success! </strong> Changes saved.");
        $this->leave_name = '';
        $this->leave_duration = '';
        $this->action = '';
        return redirect()->back();
    }
}
