<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\User;
use App\ApplicationLog;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*
    * Show login form
    */
    public function signin(){
        return view('auth.login');
    }

    /*
    * Show reset password form
    */
    public function showResetPasswordForm(){
        return view('auth.passwords.reset');
    }

    /*
    * Set password
    */
    public function setPassword($token){
        $email = DB::table('password_resets')->where('token', $token);
        if(!empty($email)){
            return view('auth.passwords.confirm');
        }else{
            return redirect()->route('404');
        }
    }

	/*
	* Signin action
	*/
	public function login(Request $request){

		$this->validate($request, [
			'email'=>'required|email',
			'password'=>'required'
		]);
		$user = User::where('email', $request->email)->where('verified', 1)->first();
		if(!empty($user)){
			//this account is verified
			if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password, 'account_status'=>1], $request->remember)){
				/* $message = Auth::user()->first_name." ".Auth::user()->surname." logged in.";
				$log = new ApplicationLog;
				$log->tenant_id = Auth::user()->tenant_id;
				$log->activity = $message;
				$log->save(); */
				//check if profile is not updated
				if(empty(Auth::user()->department_id) ){
					session()->flash("update_profile", "<strong>Notice: </strong> You're adviced to complete your profile");

					return redirect()->route('my-profile');
				}else{

					return redirect()->route('activity-stream');
				}
			}else{
				 session()->flash("wrongCredentials", "<strong>Error! </strong> Wrong or invalid login credentials. Try again.");
				 return back();
			}
		}else{
			session()->flash("unverified", "<strong>Ooops!</strong> Kindly verify your account in order to login.");
			return back();
		}

	}


}
