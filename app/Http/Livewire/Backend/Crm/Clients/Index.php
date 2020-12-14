<?php

namespace App\Http\Livewire\Backend\Crm\Clients;

use Livewire\Component;
use App\Client;
use Auth;
class Index extends Component
{
    public $clients;
    public $client_name;
    public function render()
    {
        return view('livewire.backend.crm.clients.index');
    }

    public function mount(){
        $this->clients = Client::orderBy('id', 'DESC')->where('tenant_id',Auth::user()->tenant_id)->get();
    }

    public function searchForClient(){
        $this->validate([
            'client_name'=>'required'
        ]);
       // $result = Client::where('tenant_id', Auth::user()->tenant_id)
                          //->where('first_name', 'LIKE')
                          //->get();
    }
}
