<?php

namespace App\Http\Livewire\Backend\Crm\Support;

use Livewire\Component;
use App\User;
use App\Ticket as TicketModel;
use Auth;
class TicketIndex extends Component
{
    public $tickets;
    public function render()
    {
        return view('livewire.backend.crm.support.ticket-index');
    }

    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $this->tickets = TicketModel::where('tenant_id', Auth::user()->tenant_id)
                                    ->where('user_id', Auth::user()->id)
                                    ->get();
    }
}
