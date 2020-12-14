<?php

namespace App\Http\Livewire\Backend\Hr;

use Livewire\Component;
use App\QueryEmployee;
use App\QueryReply;
use Auth;

class ViewQuery extends Component
{
    public $slug;
    public $query;
    public $link;
    public $replies;
    public $query_reply;
    public function render()
    {
        return view('livewire.backend.hr.view-query');
    }

    public function mount($slug = ''){
        $this->link = request('slug', $slug);
        $this->getContent();

    }

    public function getContent(){
        try{
            $this->query = QueryEmployee::where('tenant_id', Auth::user()->tenant_id)
                                        ->where('slug', $this->link)->first();
            $this->getReplies();
        }catch(Exception $ex){

        }
    }

    public function getReplies(){
        $this->replies = QueryReply::where('from_id', Auth::id())->where('to_id', $this->query->user_id)
                                    ->orWhere('from_id', $this->query->user_id)->where('to_id', Auth::id())
                                    ->where('tenant_id', Auth::user()->tenant_id)
                                    ->get();
    }

    public function submitReply(){
        $this->validate([
            'query_reply'=>'required'
        ]);
        $reply = new QueryReply;
        $reply->from_id = Auth::user()->id;
        $reply->tenant_id = Auth::user()->tenant_id;
        $reply->to_id = $this->query->user_id;
        $reply->reply = $this->query_reply;
        $reply->query_id = $this->query->id;
        $reply->save();
        $this->query_reply = '';
        $this->getContent();

    }

    public function closeQuery($id){
        $query = QueryEmployee::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $query->status = 0; //closed
        $query->save();
        session()->flash("success", "<strong>Success!</strong> Query closed.");
        return redirect()->route('queries');
    }
}
