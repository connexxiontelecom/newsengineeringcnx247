<?php

namespace App\Http\Livewire\Backend\Workgroup;

use Livewire\Component;
use Livewire\WithPagination;
use App\Workgroup;
use App\WorkgroupPost;
use App\WorkgroupLike;
use App\WorkgroupComment;
use App\WorkgroupMember;
use Auth;

class View extends Component
{
    use WithPagination;
    public $group;
    public $link;
    public $comment;
    public $posts;
    public function render()
    {
        return view('livewire.backend.workgroup.view');
    }

    public function mount($url = ''){
        $this->link = request('url', $url);
        $this->getContent();
    }

    /*
    *Get content
    */
    public function getContent(){
        $this->group = Workgroup::where('url', $this->link)
        ->where('tenant_id',Auth::user()->tenant_id)->first();

        $check = WorkgroupMember::select('user_id')->where('workgroup_id', $this->group->id)
                                ->where('user_id', Auth::user()->id)
                                ->count();
        if($check > 0){
            $this->posts = WorkgroupPost::where('tenant_id', Auth::user()->tenant_id)
                                        ->where('group_id', $this->group->id)
                                        ->get();
        }else{
            $this->posts = [];
             session()->flash("error", "<strong>Ooops!</strong> You're not a memeber of this workgroup.");
            return redirect()->route('workgroups');
        }
    }

        /*
    * Comment on post
    */
    public function comment($id){
        $this->validate([
            'id'=>'required',
            'comment'=>'required'
        ]);
        $group = WorkgroupPost::find($id);
        $com = new WorkgroupComment;
        $com->user_id = Auth::user()->id;
        $com->workgroup_id = $group->group_id;
        $com->post_id = $id;
        $com->comment = $this->comment;
        $com->tenant_id = Auth::user()->tenant_id;
        $com->save();
        $this->comment = '';
        $this->getContent();
    }

    /*
    *Like post
    */
    public function addLike($id){
        $this->validate([
            'id'=>'required',
        ]);
        $group = WorkgroupPost::find($id);
        $like = new WorkgroupLike;
        $like->user_id = Auth::user()->id;
        $like->workgroup_id = $group->group_id;
        $like->post_id = $id;
        $like->tenant_id = Auth::user()->tenant_id;
        $like->save();
        $this->getContent();
    }
    /*
    *Unlike post
    */
    public function unLike($id){
        $this->validate([
            'id'=>'required'
        ]);
        $group = WorkgroupPost::find($id);
        $unlike = WorkgroupLike::where('post_id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->where('workgroup_id', $group->group_id)
                            ->first();
        $unlike->delete();
        $this->getContent();
    }
}
