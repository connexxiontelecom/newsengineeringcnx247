<?php

namespace App\Http\Livewire\Backend\Logistics;

use Livewire\Component;
use App\LogisticsVehicle;
use Auth;

class Vehicles extends Component
{
    public $vehicles;
    
    public function render()
    {
        return view('livewire.backend.logistics.vehicles');
    }

    public function mount(){
        $this->vehicles = LogisticsVehicle::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
    }
}
