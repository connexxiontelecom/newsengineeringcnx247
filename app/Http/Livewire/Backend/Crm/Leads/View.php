<?php

namespace App\Http\Livewire\Backend\Crm\Leads;

use Livewire\Component;
use App\Client;
use App\Lead;
use App\Conversation;
use App\ClientLog;
use App\Invoice;
use App\Receipt;
use Auth;

class View extends Component
{
    public $lead, $link, $client_id, $logs, $client;
    public $subject, $conversation, $conversations;
    public $invoices;
    public function render()
    {
        return view('livewire.backend.crm.leads.view');
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
        $this->lead = Lead::where('client_id', $this->client_id)->first();
        $this->conversations = Conversation::where('client_id', $this->client_id)
                                ->where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        $this->logs = ClientLog::where('client_id', $this->client_id)
                                ->where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        $this->invoices = Invoice::where('tenant_id', Auth::user()->tenant_id)
                                ->where('client_id', $this->client_id)->get();
    }
}
