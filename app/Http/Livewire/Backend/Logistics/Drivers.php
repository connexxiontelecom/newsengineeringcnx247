<?php

namespace App\Http\Livewire\Backend\Logistics;

use Livewire\Component;
use Livewire\WithPagination;
use App\LogisticsUser;
use Auth;

class Drivers extends Component
{
    use WithPagination;
    public $drivers;
    public $confirm_from, $confirm_to;
    public $hire_from, $hire_to;
    public $department;

    public function render()
    {
        return view('livewire.backend.logistics.drivers');
    }

    public function mount(){
        $this->getDrivers();
    }

    /*
    * Get list of all drivers
    */
    public function getDrivers(){
        $this->drivers = LogisticsUser::where('tenant_id',Auth::user()->tenant_id)
                                        ->where('role', 1)
                                        ->orderBy('first_name', 'ASC')->get();

    }
}
