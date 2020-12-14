<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Mail\PasswordReset;
use App\User;
use DB;
class ResetPassword extends Component
{
    public $email;
    public $error;
    public $success;

    public function render()
    {
        return view('livewire.frontend.reset-password');
    }

    /*
    * Reset password
    */
    public function resetPassword(){
        $this->validate([
            'email'=>'required|email'
        ]);
        $user = User::where('email', $this->email)->first();
        if(!empty($user)){
            //send an email
            $token = sha1(time());
            \Mail::to($user)->send(new PasswordReset($user, $token));
            $data=array('email'=>$user->email,"token"=>$token,"created_at"=>now());
            DB::table('password_resets')->insert($data);
            $this->success = session()->flash("success", "<strong>Great!</strong> Please click on Reset Password in the mail we sent to you.");
        }else{
            $this->error = session()->flash("error", "<strong>Ooops!</strong> It appears there's no account with this email.");
        }
    }
}
