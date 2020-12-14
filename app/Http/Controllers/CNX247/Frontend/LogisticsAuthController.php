<?php

namespace App\Http\Controllers\CNX247\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogisticsUser;
use Auth;
class LogisticsAuthController extends Controller
{
    public function login(){
        return view('backend.logistics.auth.login');
    }

            /*
    * Login user
    */
    public function loginNow(Request $request){
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required'
            ]);
            $user = LogisticsUser::where('email', $request->email)->first();
        if(!empty($user)){
            if(Auth::guard('logistic')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)){
                 return redirect()->route('logistics-account');
            }else{
                session()->flash("wrongCredentials", "<strong>Error! </strong> Wrong or invalid login credentials. Try again.");
                return back();
            }
        }else{
            session()->flash("unverified", "<strong>Ooops!</strong> Enter your login credentials.");
            return back();
        }

    }
}
