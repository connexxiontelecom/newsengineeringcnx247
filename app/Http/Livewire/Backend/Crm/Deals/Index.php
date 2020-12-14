<?php

namespace App\Http\Livewire\Backend\Crm\Deals;

use Livewire\Component;
use App\Deal;
use Auth;

class Index extends Component
{
    public $deals;
    public function render()
    {
        return view('livewire.backend.crm.deals.index');
    }

    public function mount(){
        $this->deals = Deal::orderBy('id', 'DESC')->where('tenant_id',Auth::user()->tenant_id)->get();
    }
}
