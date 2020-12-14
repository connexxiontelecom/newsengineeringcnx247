<?php

namespace App\Http\Livewire\Backend\ChatNCalls;

use Livewire\Component;
use App\User;
use App\Message;
use Auth;

class MessengerList extends Component
{
    public $users, $conversations;
    public $active_user = ''; // i.e selected user for chat/calls/video
    public $message = '';

    public function render()
    {
        return view('livewire.backend.chat-n-calls.messenger-list');
    }

    public function hydrate()
    {
        //$this->getUsers();
    }

    public function mount(){
        $this->getUsers();
        $this->conversations = [];
    }


    /*
    *
    */
    public function getUsers(){
        $this->conversations = '';
        if(Auth::check()){
            $this->users = User::where('account_status', 1)
                                ->where('verified', 1)
                                ->where('id', '!=', Auth::user()->id)
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->orderBy('first_name', 'ASC')
                                ->get();

        }else{
            return redirect()->route('signin');
        }
    }
    /*
    * Load conversations with this user
    */
    public function loadConversations($id){
        $this->conversations = [];
        $this->active_user =  User::select('first_name', 'surname', 'avatar','mobile', 'id')
                            ->where('id', $id)
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->first();
        $this->conversations = Message::where('from_id', Auth::user()->id)->where('to_id', $id)
                                ->orWhere('from_id', $id)->where('to_id',Auth::user()->id)
                                ->where('tenant_id',Auth::user()->tenant_id)
                                ->get();
    }
    /*
    * Send message
    */
    public function sendMessage(){
        $this->validate([
            'message'=>'required'
        ]);
        $send = new Message;
        $send->message = $this->message;
        $send->to_id = $this->active_user->id;
        $send->from_id = Auth::user()->id;
        $send->tenant_id = Auth::user()->tenant_id;
        $send->save();
        $this->message = '';
        $this->loadConversations($this->active_user->id);
    }
}
