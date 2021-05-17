<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\NewDriver;
use App\Driver;
use App\LogisticsUser;
use App\DriverLog;
use App\Relationship;
use App\DriverEmergency;
use App\DriverNextOfKin;
use App\DriverGuarantor;
use App\LogisticsCustomer;
use App\LogisticsVehicle;
use App\LogisticsVehicleAssignmentLog;
use App\PickupPoint;
use App\User;
use App\RenewalType;
use App\RenewalSchedule;
use Auth;
use Illuminate\Support\Facades\DB;
use Image;

class LogisticsController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->drivers = new LogisticsUser();
        $this->renew = new RenewalType();
        $this->renewSchedule = new RenewalSchedule();
    }

    public function drivers(){
	    $drivers = DB::table('logistics_users')
		    ->join('users', 'logistics_users.id', '=', 'users.id')
		    ->select('*')
		    ->get();

     return view('backend.logistics.drivers', ['drivers' => $drivers]);
    }

	public function renewalType(Request $request){
		$method = strtolower($request->method());
	if($method == 'get'):
		$renewals = DB::table('renewal_types')
			->select('*')
			->get();

		return view('backend.logistics.renewal_type', ['renewals' => $renewals]);

		endif;

		if($method == 'post'):
				if(isset($request->id)):
					$this->renew = $this->renew::find($request->id);
				endif;
			$this->renew->tenant_id = Auth::user()->tenant_id;
			$this->renew->renewal_type_name = $request->renewal_type_name;
			$this->renew->save();

			session()->flash("success", "<strong>Success!</strong> New Renewal Registered.");
			return redirect()->route('renewal-type');

			endif;
	}

    public function addNewDriver(){
        $locations = PickupPoint::where('tenant_id', Auth::user()->tenant_id)->orderBy('location', 'ASC')->get();
        $employees = User::where(['tenant_id' => Auth::user()->tenant_id,
	                                  'account_status' => 1])->get();

    return view('backend.logistics.add-new-driver', ['locations'=>$locations, 'employees' => $employees]);
    }

    public function storeDriver(Request $request){
        //return dd($request->all());
        $this->validate($request,[
            'user_id'=>'required',
            'means_of_identification'=>'required',
            'moi_attachment'=>'required',
            ]);

        if(!empty($request->file('moi_attachment'))){
            $extension = $request->file('moi_attachment');
            $extension = $request->file('moi_attachment')->getClientOriginalExtension();
            $size = $request->file('moi_attachment')->getSize();
            $dir = 'assets/uploads/logistics/';
            $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('moi_attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }

        //$driver = new LogisticsUser;
        $this->drivers->user_id = $request->user_id;
        $this->drivers->registered_by = Auth::user()->id;
        $this->drivers->tenant_id = Auth::user()->tenant_id;
        $this->drivers->type_of_identification = $request->means_of_identification;
        $this->drivers->attachment = $filename;

        //print_r($driver);
       $this->drivers->save();

        session()->flash("success", "<strong>Success!</strong> New driver registered.");
        return redirect()->route('logistics-drivers');
    }

    public function driverProfile($url){
        $driver = LogisticsUser::where('url', $url)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($driver)){
            $relationships = Relationship::orderBy('name', 'ASC')->get();
            return view('backend.logistics.driver-profile', ['driver'=>$driver, 'relationships'=>$relationships]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return redirect()->back();
        }
    }

    public function driverEmergencyContact(Request $request){
        $this->validate($request,[
            'full_name'=>'required',
            'email_address'=>'required',
            'mobile_no'=>'required',
            'address'=>'required',
            'relationship'=>'required'
        ]);

        $emergency = new DriverEmergency;
        $emergency->full_name = $request->full_name;
        $emergency->email = $request->email_address;
        $emergency->mobile_no = $request->mobile_no;
        $emergency->address = $request->address;
        $emergency->relationship = $request->relationship;
        $emergency->tenant_id = Auth::user()->tenant_id;
        $emergency->added_by = Auth::user()->id;
        $emergency->driver_id = $request->driver;
        $emergency->save();
        if($emergency){
            return response()->json(['message'=>'Success! New driver emergency contact saved.'],200);
        }else{
            return response()->json(['error'=>'Ooops! Could not register emergency contact.'],400);

        }
    }
    public function driverKinContact(Request $request){
        $this->validate($request,[
            'full_name'=>'required',
            'email_address'=>'required',
            'mobile_no'=>'required',
            'address'=>'required',
            'relationship'=>'required'
        ]);

        $kin = new DriverNextOfKin;
        $kin->full_name = $request->full_name;
        $kin->email = $request->email_address;
        $kin->mobile_no = $request->mobile_no;
        $kin->address = $request->address;
        $kin->relationship = $request->relationship;
        $kin->tenant_id = Auth::user()->tenant_id;
        $kin->added_by = Auth::user()->id;
        $kin->driver_id = $request->driver;
        $kin->save();
        if($kin){
            return response()->json(['message'=>'Success! New next of kin contact saved.'],200);
        }else{
            return response()->json(['error'=>'Ooops! Could not register next of kin.'],400);

        }
    }
    public function driverGuarantorContact(Request $request){
        $this->validate($request,[
            'full_name'=>'required',
            'email_address'=>'required',
            'mobile_no'=>'required',
            'address'=>'required',
            'relationship'=>'required'
        ]);

        $kin = new DriverGuarantor;
        $kin->full_name = $request->full_name;
        $kin->email = $request->email_address;
        $kin->mobile_no = $request->mobile_no;
        $kin->address = $request->address;
        $kin->relationship = $request->relationship;
        $kin->tenant_id = Auth::user()->tenant_id;
        $kin->added_by = Auth::user()->id;
        $kin->driver_id = $request->driver;
        $kin->save();
        if($kin){
            return response()->json(['message'=>'Success! New guarantor save.'],200);
        }else{
            return response()->json(['error'=>'Ooops! Could not register guarantor.'],400);

        }
    }

    public function customers(){
        return view('backend.logistics.customers');
    }
    public function storeCustomer(Request $request){
        $this->validate($request,[
            'full_name'=>'required',
            'email'=>'required|email',
            'mobile_no'=>'required',
            'address'=>'required',
            'gender'=>'required'
        ]);
        $password = substr(sha1(time()), 32,40);
        $customer = new LogisticsCustomer;
        $customer->full_name = $request->full_name;
        $customer->email = $request->email;
        $customer->mobile_no = $request->mobile_no;
        $customer->address = $request->address;
        $customer->gender = $request->gender;
        $customer->tenant_id = Auth::user()->tenant_id;
        $customer->added_by = Auth::user()->id;
        $customer->save();
        session()->flash("success", "<strong>Success!</strong> Customer registered.");
        return redirect()->route('logistics-customers');
    }

    public function vehicles(){
	    $vehicles = LogisticsVehicle::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        return view('backend.logistics.vehicles', ['vehicles' => $vehicles]);
    }
    public function newVehicle(){
        return view('backend.logistics.add-new-vehicle');
    }
    public function storeVehicle(Request $request){
        //return dd($request->all());
        $this->validate($request,[
            'chassis_no'=>'required',
            'registration_no'=>'required',
            'registration_date'=>'required',
            'engine_no'=>'required',
            'owner_name'=>'required',
            'maker_model'=>'required'
        ]);
        if(!empty($request->file('image'))){
            $extension = $request->file('image');
            $extension = $request->file('image')->getClientOriginalExtension();
            $size = $request->file('image')->getSize();
            $dir = 'assets/uploads/logistics/vehicles/';
            $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('image')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }
        $vehicle = new LogisticsVehicle;
        $vehicle->chassis_no = $request->chassis_no;
        $vehicle->registration_no = $request->registration_no;
        $vehicle->registration_date = $request->registration_date;
        $vehicle->engine_no = $request->engine_no;
        $vehicle->owner_name = $request->owner_name;
        $vehicle->make_model = $request->maker_model;
        $vehicle->tenant_id = Auth::user()->tenant_id;
        $vehicle->added_by = Auth::user()->id;
        $vehicle->image = $filename;
        $vehicle->slug = substr(sha1(time()), 23,40);
        $vehicle->save();
        session()->flash("success", "<strong>Success!</strong> New vehicle saved.");
        return redirect()->route('logistics-vehicles');
    }

    public function viewVehicle(Request $request, $slug){

	    $method = strtolower($request->method());
	    if($method == 'get'):
		    $vehicle = LogisticsVehicle::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
		    if(!empty($vehicle)){
			    //$drivers = LogisticsUser::where('tenant_id', Auth::user()->tenant_id)->where('role', 1)->get();
			    $drivers = DB::table('logistics_users')
				    ->join('users', 'logistics_users.id', '=', 'users.id')
				    ->select('*')
				    ->get();
			    $employees = User::where(['tenant_id' => Auth::user()->tenant_id,
				    'account_status' => 1])->get();

			    $renewals = DB::table('renewal_types')
				    ->select('*')
				    ->get();

			    $renewal_schedules = DB::table('renewal_schedules')
				   ->select( '*')
				    ->where('renewal_schedule_vehicle_id', $vehicle->id)
				    ->join('renewal_types', 'renewal_schedules.renewal_schedule_type_id', '=', 'renewal_types.id')
				    ->join('users', 'renewal_schedules.renewal_schedule_user_id', '=', 'users.id')
				    ->get();

//			    $renewa_schedules = DB::table('renewal_schedules')
//				    ->select('id as rid')
//				    ->where('renewal_schedule_vehicle_id', $vehicle->id)
//				    ->get();
//			    $enewal_schedules =  ((array)$renewal_schedules + (array)$renewa_schedules);
//
//			    //$renewal_schedules = (object) array_merge((array) $_renewal_schedules,(array) $renewal_schedules );
//
//			    print_r($enewal_schedules);

			    //$renewal_schedules = array_merge($renewal_schedules,  $_renewal_schedules);

			    $logs = LogisticsVehicleAssignmentLog::where('tenant_id', Auth::user()->tenant_id)
				    ->where('vehicle_id', $vehicle->id)
				    ->orderBy('id', 'DESC')->get();


			    return view('backend.logistics.vehicle-details', ['vehicle'=>$vehicle,'drivers'=>$drivers, 'logs'=>$logs, 'renewals' => $renewals, 'employees' => $employees, 'renewal_schedules' => $renewal_schedules]);
		    }else{
			    session()->flash("error", "<strong>Ooops!</strong> Vehicle not found.");
			    return redirect()->route('logistics-vehicles');
		    }

	    endif;

	    if($method == 'post'):

		    $check =   DB::table('renewal_schedules')
									    ->select('*')
									    ->where(['renewal_schedule_type_id' => $request->renewal_schedule_type_id,
										    'renewal_schedule_vehicle_id' => $request->renewal_schedule_vehicle_id])

			                ->first();

	    if(!empty($check)):
				$this->renewSchedule = $this->renewSchedule::find($check->id);
		  endif;


		    $this->renewSchedule->tenant_id = Auth::user()->tenant_id;
		    $this->renewSchedule->renewal_schedule_type_id = $request->renewal_schedule_type_id;
		    $this->renewSchedule->renewal_schedule_vehicle_id = $request->renewal_schedule_vehicle_id;
		    $this->renewSchedule->renewal_schedule_date = $request->renewal_schedule_date;
		    $this->renewSchedule->renewal_schedule_user_id = $request->renewal_schedule_user_id;
		    $this->renewSchedule->save();

		    session()->flash("success", "<strong>Success!</strong> Renewal Schedule Registered.");
		    $_route = 'logistics/view-vehicle/'.$slug;
		    return redirect($_route);

	    endif;


//        return view('backend.logistics.add-new-customer');
    }

	public function renewalSchedule(Request $request){

		$method = strtolower($request->method());
		if($method == 'get'):
			$renewal_schedules = DB::table('renewal_schedules')
				->select( '*')
				->join('renewal_types', 'renewal_schedules.renewal_schedule_type_id', '=', 'renewal_types.id')
				->join('logistics_vehicles', 'renewal_schedules.renewal_schedule_vehicle_id', '=', 'logistics_vehicles.id')
				->join('users', 'renewal_schedules.renewal_schedule_user_id', '=', 'users.id')
				->orderBy('renewal_schedules.renewal_schedule_date', 'asc')
				->get();

			return view('backend.logistics.renewal-schedule', ['renewal_schedules' => $renewal_schedules]);


		endif;

		if($method == 'post'):

			$check =   DB::table('renewal_schedules')
				->select('*')
				->where(['renewal_schedule_type_id' => $request->renewal_schedule_type_id,
					'renewal_schedule_vehicle_id' => $request->renewal_schedule_vehicle_id])

				->first();

			if(!empty($check)):
				$this->renewSchedule = $this->renewSchedule::find($check->id);
			endif;


			$this->renewSchedule->tenant_id = Auth::user()->tenant_id;
			$this->renewSchedule->renewal_schedule_type_id = $request->renewal_schedule_type_id;
			$this->renewSchedule->renewal_schedule_vehicle_id = $request->renewal_schedule_vehicle_id;
			$this->renewSchedule->renewal_schedule_date = $request->renewal_schedule_date;
			$this->renewSchedule->renewal_schedule_user_id = $request->renewal_schedule_user_id;
			$this->renewSchedule->save();

			session()->flash("success", "<strong>Success!</strong> Renewal Schedule Registered.");
			$_route = 'logistics/view-vehicle/'.$slug;
			return redirect($_route);

		endif;


//        return view('backend.logistics.add-new-customer');
	}
    public function newCustomer(){
        return view('backend.logistics.add-new-customer');
    }
    public function shipping(){
        return view('backend.logistics.shipping');
    }

    public function assignVehicleToDriver(Request $request){
        $this->validate($request,[
            'vehicle'=>'required',
            'driver'=>'required'
        ]);
        $vehicleTaken = LogisticsUser::where('vehicle_id', $request->vehicle)
                                                ->where('tenant_id', Auth::user()->tenant_id)
                                                ->first();
        $driverTaken = LogisticsVehicle::where('assigned_to', $request->driver)
                                                ->where('tenant_id', Auth::user()->tenant_id)
                                                ->first();
        if(!empty($vehicleTaken)){
            $vehicleTaken->vehicle_id = null; //take vehicle from driver
            $vehicleTaken->save();
            #Assign to new person
            $newDriver = LogisticsUser::where('tenant_id', Auth::user()->tenant_id)
                                    ->where('id', $request->driver)
                                    ->first();
            $newDriver->vehicle_id = $request->vehicle;
            $newDriver->save();
        }else{
            $newDriver = LogisticsUser::where('tenant_id', Auth::user()->tenant_id)
                                    ->where('id', $request->driver)
                                    ->first();
            $newDriver->vehicle_id = $request->vehicle;
            $newDriver->save();
        }

        if(!empty($driverTaken)){
            #Vehicle
            $driverTaken->assigned_to = null; //vehicle not assigned to anyone
            $driverTaken->save();
        }else{
            #vehicle
            $newVehicle = LogisticsVehicle::where('id', $request->vehicle)->where('tenant_id', Auth::user()->tenant_id)->first();
            $newVehicle->assigned_to = $request->driver;
            $newVehicle->save();
        }
        $log = new LogisticsVehicleAssignmentLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->vehicle_id = $request->vehicle;
        $log->driver_id = $request->driver;
        $log->assigned_by = Auth::user()->id;
        $log->save();
        if($log){
            return response()->json(['message'=>'Success! Vehicle assigned'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Could not assign vehicle.'], 400);
        }
    }
    public function newShipping(){
        return view('backend.logistics.add-new-shipping');
    }
    public function pickupPoints(){
        $locations = PickupPoint::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        return view('backend.logistics.pick-up-points', ['locations'=>$locations]);
    }
    public function storePickupPoint(Request $request){
        $this->validate($request,[
            'location'=>'required',
            'address'=>'required'
        ]);
        $pick = new PickupPoint;
        $pick->address = $request->address;
        $pick->location = $request->location;
        $pick->added_by = Auth::user()->id;
        $pick->tenant_id = Auth::user()->tenant_id;
        $pick->save();
        if($pick){
            return response()->json(['message'=>'Success! Pickup location registered.'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Could not register pickup location.'], 400);

        }
    }
    public function editPickupPoint(Request $request){
        $this->validate($request,[
            'location'=>'required',
            'address'=>'required'
        ]);
        $pick = PickupPoint::where('tenant_id', Auth::user()->tenant_id)->where('id', $request->pickup)->first();
        $pick->address = $request->address;
        $pick->location = $request->location;
        $pick->added_by = Auth::user()->id;
        $pick->tenant_id = Auth::user()->tenant_id;
        $pick->save();
        if($pick){
            return response()->json(['message'=>'Success! Changes saved.'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Could not effect changes.'], 400);

        }
    }

    public function changeUserAvatar(Request $request){
        $this->validate($request,[
            'avatar'=>'required'
        ]);
        if($request->avatar){
    	    $file_name = time().'.'.explode('/', explode(':', substr($request->avatar, 0, strpos($request->avatar, ';')))[1])[1];
    	    //avatar image
    	    \Image::make($request->avatar)->resize(358, 358)->save(public_path('assets/uploads/logistics/avatars/medium/').$file_name);
    	    \Image::make($request->avatar)->resize(228, 228)->save(public_path('assets/uploads/logistics/avatars/thumbnails/').$file_name);


        }
        $user = LogisticsUser::find($request->user);
        $user->avatar = $file_name;
        $user->save();
        if($user){
            return response()->json(['message'=>'Success! Avatar changed.'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Could not set avatar'], 400);

        }
    }

    public function allLogs(){
        $logs = DriverLog::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.logistics.all-logs',['logs'=>$logs]);
    }
}
