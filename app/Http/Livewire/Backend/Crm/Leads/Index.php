<?php

namespace App\Http\Livewire\Backend\Crm\Leads;

use Livewire\Component;
use App\Lead;
use Auth;

class Index extends Component
{
    public $leads;
    public function render()
    {
        return view('livewire.backend.crm.leads.index');
    }
    public function mount(){
        $this->leads = Lead::orderBy('id', 'DESC')->where('tenant_id',Auth::user()->tenant_id)->get();
    }
}
