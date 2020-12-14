<?php

namespace App\Http\Livewire\Backend\User\Settings\Security;

use Livewire\Component;
use App\User;
use Auth;
use Hash;

class ChangePassword extends Component
{
    public $password, $current_password, $password_confirmation;
    public $transaction_password, $confirm_transaction_password;
    public function render()
    {
        return view('livewire.backend.user.settings.security.change-password');
    }

    public function changePassword(){
        $this->validate([
            'current_password'=>'required',
            'password'=>'required|confirmed'
        ]);
        $user = User::find(Auth::user()->id);
        if (Hash::check($this->current_password, $user->password)) {
            $user->password = bcrypt($this->password);
            $user->save();
            $this->current_password = '';
            $this->password = '';
            $this->password_confirmation = '';
            session()->flash("success", "<strong>Success!</strong> Password changed.");
            return back();
        }else{
            session()->flash("warning", "<strong>Ooops!</strong> Current password does not match our record. Try again.");
            $this->current_password = '';
            $this->password = '';
            $this->password_confirmation = '';
            return back();
          }
    }

    public function setTransactionPassword(){
        $this->validate([
            'transaction_password'=>'required',
            'confirm_transaction_password'=>'required'
        ]);
        $transaction = User::where('tenant_id', Auth::user()->tenant_id)->where('id', Auth::user()->id)->first();
        $transaction->transaction_password = bcrypt($this->transaction_password);
        $transaction->save();
        session()->flash("trans_success", "<strong>Success!</strong> New transaction password set.");
        return back();
    }
}
