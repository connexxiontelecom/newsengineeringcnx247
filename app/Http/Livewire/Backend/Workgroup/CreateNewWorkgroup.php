<?php

namespace App\Http\Livewire\Backend\Workgroup;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\User;
use App\Workgroup;
use App\WorkgroupMember;
use App\WorkgroupModerator;
use Auth;

class CreateNewWorkgroup extends Component
{
    use WithFileUploads;
    public $users;
    public $workgroup_name, $description, $workgroup_members, $group_image;
    public $moderators;
    public function render()
    {
        return view('livewire.backend.workgroup.create-new-workgroup');
    }

    public function mount(){
        return $this->users = User::select('first_name', 'surname', 'id')
                            ->where('account_status',1)->where('verified', 1)
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->orderBy('first_name', 'ASC')->get();
    }

    /*
    *Create workgroup
    */
    public function createWorkgroup(){
        $this->validate([
            'workgroup_name'=>'required',
            'description'=>'required',
            'workgroup_members'=>'required'
        ]);
        if(!empty($this->group_image)){
            $filename = Auth::user()->tenant->company_name.'_'.time().date('Y').'.'.$this->group_image->extension();
            $this->group_image->storeAs('workgroup', $filename);
        }
        $group = new Workgroup;
        $group->group_name = $this->workgroup_name;
        $group->description = $this->description;
        $group->group_image = $filename ?? '';
        $group->url = substr(sha1(time()),24,40);
        $group->tenant_id = Auth::user()->tenant_id;
        $group->owner = Auth::user()->id;
        $group->save();
        $groupId = $group->id;
        //workgroup members
        if(!empty($this->workgroup_members)){
            foreach($this->workgroup_members as $member){
                $mem = new WorkgroupMember;
                $mem->workgroup_id = $groupId;
                $mem->user_id = $member;
                $mem->request_status = 1; //approved
                $mem->tenant_id = Auth::user()->tenant_id;
                $mem->save();
            }
        }
        //workgroup moderators or responsible persons
        if(!empty($this->moderators)){
            foreach($this->moderators as $moderator){
                $mode = new WorkgroupModerator;
                $mode->workgroup_id = $groupId;
                $mode->user_id = $moderator;
                $mode->request_status = 1; //approved
                $mode->tenant_id = Auth::user()->tenant_id;
                $mode->save();
            }
        }

        session()->flash("success", "<strong>Success!</strong> New workgroup created.");
        return redirect()->route('workgroups');
    }
}
