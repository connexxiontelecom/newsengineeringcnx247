<?php

namespace App\Http\Livewire\Backend\Hr;

use Livewire\Component;
use App\User;
use App\LeaveWallet as LeaveRequestWallet;
use Auth;

class LeaveWallet extends Component
{
    public $employee, $amount, $expires;
    public $wallet;
    public function render()
    {
        $employees = User::orderBy('first_name', 'ASC')->where('tenant_id',Auth::user()->tenant_id)->get();
        return view('livewire.backend.hr.leave-wallet', ['employees'=>$employees]);
    }

    public function mount(){
        $this->wallet = LeaveRequestWallet::orderBy('id', 'DESC')->get();
    }

    /*
    * Add to wallet
    */
    public function addToIndividualWallet(){
        $this->validate([
            'employee' => 'required',
            'amount' => 'required',
            'expires' => 'required'
        ]);

        $wallet = new LeaveRequestWallet;
        $wallet->user_id = $this->employee;
        $wallet->amount = $this->amount;
        $wallet->balance = $this->amount;
        $wallet->expires = $this->expires;
        $wallet->tenant_id = Auth::user()->tenant_id;
        $wallet->save();
        session()->flash("success", "<strong>Success!</strong> Record saved.");
    }
}
