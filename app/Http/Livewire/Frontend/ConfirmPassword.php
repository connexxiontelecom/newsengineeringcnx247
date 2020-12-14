<?php

namespace App\Http\Livewire\Frontend;
use App\User;
use Auth;
use DB;

use Livewire\Component;

class ConfirmPassword extends Component
{   public $password;
    public $password_confirmation;
    public $error;
    public $success;
    public $link;
    public $user;
    public $email;
    public function render()
    {
        return view('livewire.frontend.confirm-password');
    }

    public function mount($token = ''){
        $this->link = request('token', $token);
        $user = DB::table('password_resets')->select('email')->where('token', $this->link)->first();
        $this->email = $user->email;
    }


    /*
    * Set new password
    */
    public function setNewPassword(){
        $this->validate([
            'password'=>'required|confirmed'
        ]);

        $change = User::where('email', $this->email)->first();
        if(!empty($change) ){
            $change->password = bcrypt($this->password);
            $change->save();
            $reset = DB::table('password_resets')->where('token', $this->link)->delete();
            session()->flash("success", "<strong>Success!</strong> Password reset.");
            return redirect()->route('signin');
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Password reset failed.");
        }

    }
}
