<?php

namespace App\Http\Livewire\Backend\Workgroup;

use Livewire\Component;
use App\Workgroup;
use App\WorkgroupMember;
use App\workgroupModerator;
use Auth;

class Index extends Component
{
    public $groups;
    public function render()
    {

        return view('livewire.backend.workgroup.index');
    }

    public function mount(){
        $this->groups = Workgroup::where('tenant_id',Auth::user()->tenant_id)->latest()->get();
    }
}
