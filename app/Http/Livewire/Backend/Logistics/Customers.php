<?php

namespace App\Http\Livewire\Backend\Logistics;

use Livewire\Component;
use App\LogisticsCustomer;
use Auth;

class Customers extends Component
{
    public $customers;

    public function render()
    {
        return view('livewire.backend.logistics.customers');
    }

    public function mount(){
        $this->customers = LogisticsCustomer::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
    }
}
