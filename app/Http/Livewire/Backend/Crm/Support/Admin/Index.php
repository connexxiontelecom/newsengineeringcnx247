<?php

namespace App\Http\Livewire\Backend\Crm\Support\Admin;

use Livewire\Component;
use App\Ticket;
use App\TicketCategory;
use Auth;
class Index extends Component
{
    public $tickets;
    public $categories;

    public function render()
    {
        return view('livewire.backend.crm.support.admin.index');
    }

    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $this->tickets = Ticket::orderBy('id', 'DESC')->get();
        $this->categories = TicketCategory::orderBy('id', 'DESC')->get();
    }
}
