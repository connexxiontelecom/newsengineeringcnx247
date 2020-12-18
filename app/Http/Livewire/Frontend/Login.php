<?php

namespace App\Http\Livewire\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;
use App\User;

class Login extends Component
{
    public $password, $email, $remember;
    public $error;

    public function render()
    {
        return view('livewire.frontend.login');
    }

    /*
    * Login user
    */
    public function loginNow(){
        $this->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $user = User::where('email', $this->email)->where('verified', 1)->first();
        if(!empty($user)){
            //this account is verified
            if(Auth::attempt(['email'=>$this->email, 'password'=>$this->password, 'account_status'=>1], $this->remember)){
								$users = User::where('tenant_id', Auth::user()->tenant_id)->get();
								$date = Carbon::now();
								foreach($users as $user){
									//if($date->parse($user->birth_date)->format('m-d') >= $date->format('m-d')){
											//$exist = User::where('tenant_id', Auth::user()->tenant_id)->where('id', Auth::user()->id)->first();
											$years = \Carbon\Carbon::parse(\Carbon\Carbon::now())->diff($user->birth_date);
											$user->next_birth_date = $user->birth_date->addYears($year);
											$user->save();
									//}
								}
                //check if profile is not updated
                if(empty(Auth::user()->department_id) ){
                    session()->flash("update_profile", "<strong>Notice: </strong> You're adviced to complete your profile");
                    return redirect()->route('my-profile');
                }else{

                    return redirect()->route('activity-stream');
                }
            }else{
                $this->error = session()->flash("wrongCredentials", "<strong>Error! </strong> Wrong or invalid login credentials. Try again.");
            }
        }else{
            $this->error = session()->flash("unverified", "<strong>Ooops!</strong> Kindly verify your account in order to login.");
        }

    }
}
