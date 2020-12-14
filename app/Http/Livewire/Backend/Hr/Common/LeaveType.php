<?php

namespace App\Http\Livewire\Backend\Hr\Common;

use Livewire\Component;
use App\Department;
use App\User;
use App\LeaveType as LeaveTypeModel;
use Auth;

class LeaveType extends Component
{
    public $leave_name, $duration;
    public function render()
    {
        return view('livewire.backend.hr.common.leave-type');
    }
}
