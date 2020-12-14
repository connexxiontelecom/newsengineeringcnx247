<?php

namespace App\Http\Livewire\Backend\Crm\Clients;

use Livewire\Component;
use App\Client;
use App\Conversation;
use App\ClientLog;
use Auth;
class View extends Component
{
    public $client, $link, $client_id, $logs;
    public $subject, $conversation, $conversations;
    public function render()
    {
        return view('livewire.backend.crm.clients.view');
    }

    public function mount($slug = ''){
        $this->link = request('slug', $slug);
        $this->getContent();
    }

    /*
    * Get client info
    */
    public function getContent(){
        $this->client = Client::where('slug', $this->link)->where('tenant_id', Auth::user()->tenant_id)->first();
        $this->client_id = $this->client->id;
        $this->conversations = Conversation::where('client_id', $this->client_id)
                                ->where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        $this->logs = ClientLog::where('client_id', $this->client_id)
                                ->where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
    }

    /*
    * Submit conversation
    */
    public function submitConversation(){
        $this->validate([
            'subject'=>'required',
            'conversation'=>'required'
        ]);
        $conversation = new Conversation;
        $conversation->subject = $this->subject;
        $conversation->conversation = $this->conversation;
        $conversation->tenant_id = Auth::user()->tenant_id;
        $conversation->client_id = $this->client_id;
        $conversation->user_id = Auth::user()->id;
        $conversation->save();

        #Clear input fields
        $this->conversation = '';
        $this->subject = '';
        //register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $this->client_id;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' updated conversation with client.';
        $log->save();
        $this->getContent();

    }
}
