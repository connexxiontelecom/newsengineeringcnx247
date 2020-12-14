<?php

namespace App\Http\Controllers\CNX247\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogisticUser;
use App\DriverLog;
use Hash;
use Auth;
class LogisticsController extends Controller
{
        //
        public function __construct(){
            $this->middleware('auth:logistic');
        }

        public function myAccount(){
            return view('frontend.logistics.driver.my-account');
        }
        public function log(){
            $logs = DriverLog::where('tenant_id', Auth::user()->tenant_id)->where('driver_id', Auth::user()->id)->get();
            return view('frontend.logistics.driver.log',['logs'=>$logs]);
        }
        public function checkIn(){
            return view('frontend.logistics.driver.check-in');
        }
        public function storeCheckIn(Request $request){
            $this->validate($request,[
                'destination'=>'required'
            ]);
            $log = new DriverLog;
            $log->driver_id = Auth::user()->id;
            $log->tenant_id = Auth::user()->tenant_id;
            $log->check_in = now();
            $log->destination = $request->destination;
            $log->comment = $request->comment;
            $log->save();
            session()->flash("success", "<strong>Success!</strong> You're now checked-in. Remember to check-out when you're back.");
            return redirect()->route('logistics-log');
        }
        public function checkOut($id){
            $log = DriverLog::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->where('driver_id', Auth::user()->id)->first();
            $log->check_out = now();
            $log->save();
            session()->flash("success", "<strong>Success!</strong> You checked out.");
            return redirect()->route('logistics-log');
        }
}
