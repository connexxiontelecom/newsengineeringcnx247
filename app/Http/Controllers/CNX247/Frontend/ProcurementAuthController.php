<?php

namespace App\Http\Controllers\CNX247\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;
use Auth;

class ProcurementAuthController extends Controller
{
    //

    public function login(){
        return view('backend.procurement.supplier.auth.login');
    }

        /*
    * Login user
    */
    public function loginNow(Request $request){
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required'
        ]);
        $user = Supplier::where('company_email', $request->email)->first();
        if(!empty($user)){
            if(Auth::guard('supplier')->attempt(['company_email'=>$request->email, 'password'=>$request->password], $request->remember)){
                 return redirect()->route('supplier-account');
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
