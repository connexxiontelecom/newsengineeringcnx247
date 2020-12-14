<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Mail\WelcomeMail;
use App\User;


class Signup extends Component
{
/*     public $form = [
        'email'=>'',
        'password'=>'',
        'password_confirmation'=>'',
        'first_name'=>'',
        'terms'=>''
    ]; */
    public $email, $password, $password_confirmation, $first_name, $terms;
    public $link;



    public function render()
    {
        return view('livewire.frontend.signup');
    }






    /*
    * Signup
    */
    public function signupNow(){
        //dd($this->form);
        $this->validate([
            'email'=>'required|email',
            'password'=>'required|confirmed',
            'first_name'=>'required',
            'terms'=>'required'
        ]);
        $user = new User;
        $user->first_name = $this->first_name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->verification_link = substr(sha1(time()), 5,15);
        $user->url= substr(sha1(time()), 5,15);
        $user->save();
        \Mail::to($user)->send(new WelcomeMail($user));
        return redirect()->route('email-verification');
    }


}
