<?php

namespace App\Http\Livewire\Backend\Workflow\Announcement;

use Livewire\Component;
use App\RequestTable;
use App\BusinessLog;
use App\RequestActivityLog;
use App\RequestApprover;
use App\ResponsiblePerson;
use App\Post;
use App\User;
use App\Department;
use Auth;

class Announcement extends Component
{
    public $subject, $receiver;
    public $content, $attachment;
    public $users, $departments;
    public $target = 'all';
    public $department = 1; //selected department ID

    public function render()
    {
        return view('livewire.backend.workflow.announcement.announcement');
    }

    public function mount(){
        $this->departments = Department::orderBy('department_name', 'ASC')->where('tenant_id',Auth::user()->tenant_id)->get();
        $this->users = User::orderBy('first_name', 'ASC')->where('tenant_id',Auth::user()->tenant_id)->get();
    }

}
