<?php

namespace App\Http\Livewire\Backend\Workgroup;

use Livewire\Component;
use App\User;
use App\Workgroup;
use App\Priority;
use App\Status;
use App\WorkgroupMember;
use Auth;

class Shortcut extends Component
{
    public $users;
    public $link;
    public $members;
    public $priorities;
    public $statuses;
    public $groupInstance;

    public function render()
    {
        return view('livewire.backend.workgroup.shortcut');
    }

    public function mount($url = ''){
        $this->link = request('url', $url);
        $this->getContent();

    }

    public function getContent(){
        $this->groupInstance = Workgroup::where('url', $this->link)
                                ->where('tenant_id',Auth::user()->tenant_id)->first();
        $this->members = WorkgroupMember::select('user_id')
                                        ->where('tenant_id',Auth::user()->tenant_id)
                                        ->where('workgroup_id', $this->groupInstance->id)->get();
        $this->priorities = Priority::all();
        $this->statuses = Status::all();
        $membersId = array();
        foreach ($this->members as $per) {
            array_push($membersId,$per->user_id);
        }
        $this->users = User::orderBy('first_name', 'ASC')
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->whereIn('id', $membersId)
                            ->get();
    }

}
