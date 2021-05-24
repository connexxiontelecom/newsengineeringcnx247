<?php

	namespace App\Http\Controllers\CNX247\Backend;

	use App\Http\Controllers\Controller;
	use Illuminate\Database\Eloquent\Model;
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
	use DateTime;
	use App\VehicleType;
	use App\MaintenanceType;
	use App\MaintenanceSchedule;
	class LogisticsController extends Controller
	{
		//
		public function __construct(){
			$this->middleware('auth');
			$this->drivers = new LogisticsUser();
			$this->renew = new RenewalType();
			$this->renewSchedule = new RenewalSchedule();
			$this->vehicletype = new VehicleType();
			$this->maintenanceType = new MaintenanceType();
			$this->maintenanceSchedule = new MaintenanceSchedule();
		}

		public function drivers(){
			$drivers = DB::table('logistics_users')
				->join('users', 'logistics_users.user_id', '=', 'users.id')
				->select('*')
				->get();

			//print_r($drivers);

			return view('backend.logistics.drivers', ['drivers' => $drivers]);
		}

		public function addNewDriver(){
			$locations = PickupPoint::where('tenant_id', Auth::user()->tenant_id)->orderBy('location', 'ASC')->get();
			$employees = User::where(['tenant_id' => Auth::user()->tenant_id,
				'account_status' => 1])->get();

			return view('backend.logistics.add-new-driver', ['locations'=>$locations, 'employees' => $employees]);
		}

		public function vehicles(){
			//LogisticsVehicle::where('tenant_id', Auth::user()->tenant_id)->orderBy('status', 'DESC')->orderBy('id', 'DESC')->get();

			$vehicles = DB::table('logistics_vehicles')
				->join('vehicle_types','logistics_vehicles.type', '=', 'vehicle_types.id')
				//->where('logistics_vehicles.tenant_id', Auth::user()->tenant_id)
				->where('logistics_vehicles.status', '=', 1)
				->orderBy('logistics_vehicles.status', 'DESC')
				->orderBy('logistics_vehicles.id', 'DESC')
				->get();

			return view('backend.logistics.vehicles', ['vehicles' => $vehicles]);
		}

		public function dvehicles(){
			//LogisticsVehicle::where('tenant_id', Auth::user()->tenant_id)->orderBy('status', 'DESC')->orderBy('id', 'DESC')->get();

			$vehicles = DB::table('logistics_vehicles')
				->join('vehicle_types','logistics_vehicles.type', '=', 'vehicle_types.id')
				//->where('logistics_vehicles.tenant_id', Auth::user()->tenant_id)
				->where('logistics_vehicles.status', '=', 0)
				->orderBy('logistics_vehicles.status', 'DESC')
				->orderBy('logistics_vehicles.id', 'DESC')
				->get();

			return view('backend.logistics.vehicles', ['vehicles' => $vehicles]);
		}

		public function newVehicle(){
			$vehicles = DB::table('vehicle_types')
				->select('*')
				->get();


			return view('backend.logistics.add-new-vehicle', ['vehicles' => $vehicles]);
		}

		public function storeVehicle(Request $request){
//        $this->validate($request,[
//            'chassis_no'=>'required',
//            'registration_no'=>'required',
//            'registration_date'=>'required',
//            'engine_no'=>'required',
//            'owner_name'=>'required',
//            'maker_model'=>'required'
//        ]);
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
			$message = "<strong>Success!</strong> New vehicle saved.";
			if(isset($request->id)):
				$vehicle = $vehicle::find($request->id);
				$vehicle->status = $request->status;
				$message = "<strong>Success!</strong> Vehicle Updated.";
			endif;


			$vehicle->color = $request->color;
			$vehicle->brand = $request->brand;
			$vehicle->purchase_price = $request->purchase_price;
			$vehicle->engine_type = $request->engine_type;
			$vehicle->year = $request->year;
			$vehicle->mileage = $request->mileage;
			$vehicle->policy_number = $request->policy_number;
			$vehicle->chassis_no = $request->chassis_no;
			$vehicle->plate_no = $request->plate_no;
			$dueDateInstance = new DateTime($request->purchase_date);
			$vehicle->purchase_date = $dueDateInstance->format('Y-m-d H:i:s');
			$vehicle->owner_name = 'News Engr';
			$vehicle->make_model = $request->make_model;
			$vehicle->tenant_id = Auth::user()->tenant_id;
			$vehicle->added_by = Auth::user()->id;
			$vehicle->image = $filename;
			$vehicle->slug = substr(sha1(time()), 23,40);
			$vehicle->tank_capacity = $request->tank_capacity;
			$vehicle->type = $request->vehicle_type;
			$vehicle->save();

			session()->flash("success", $message);
			return redirect()->route('logistics-vehicles');
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

		public function vehicleType(Request $request){
			$method = strtolower($request->method());
			if($method == 'get'):
				$vehicles = DB::table('vehicle_types')
					->select('*')
					->get();

				return view('backend.logistics.vehicle_type', ['vehicles' => $vehicles]);

			endif;

			if($method == 'post'):
				if(isset($request->id)):
					$this->vehicletype = $this->vehicletype::find($request->id);
				endif;
				$this->vehicletype->tenant_id = Auth::user()->tenant_id;
				$this->vehicletype->vehicle_type_name = $request->vehicle_type_name;
				$this->vehicletype->save();

				session()->flash("success", "<strong>Success!</strong> New Vehicle Registered.");
				return redirect()->route('vehicle-type');

			endif;
		}

		public function viewVehicle(Request $request, $slug){

			$method = strtolower($request->method());
			if($method == 'get'):
				$vehicle = LogisticsVehicle::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
				$vehicle = DB::table('logistics_vehicles')
					->join('vehicle_types','logistics_vehicles.type', '=', 'vehicle_types.id')
					->where('slug', $slug)

					->first();

				if(!empty($vehicle)){
					//$drivers = LogisticsUser::where('tenant_id', Auth::user()->tenant_id)->where('role', 1)->get();
					$drivers = DB::table('logistics_users')
						->join('users', 'logistics_users.user_id', '=', 'users.id')
						->select('*')
						->where('users.account_status', '=', 1)
						->get();




					$employees = User::where(['tenant_id' => Auth::user()->tenant_id,
						'account_status' => 1])->get();

					$renewals = DB::table('renewal_types')
						->select('*')
						->get();

					$maintenances = DB::table('maintenance_types')
						->select('*')
						->get();

					$renewal_schedules = DB::table('renewal_schedules')
						->select( '*')
						->where('renewal_schedule_vehicle_id', $vehicle->id)
						->join('renewal_types', 'renewal_schedules.renewal_schedule_type_id', '=', 'renewal_types.id')
						->join('users', 'renewal_schedules.renewal_schedule_user_id', '=', 'users.id')
						->orderBy('renewal_schedules.renewal_schedule_renew_date', 'ASC')
						->get();

					$maintenance_schedules = DB::table('maintenance_schedules')
						->select( '*')
						->where('maintenance_schedule_vehicle_id', $vehicle->id)
						->join('maintenance_types', 'maintenance_schedules.maintenance_schedule_type_id', '=', 'maintenance_types.id')
						->join('users', 'maintenance_schedules.maintenance_schedule_user_id', '=', 'users.id')
						->orderBy('maintenance_schedules.maintenance_schedule_due_date', 'ASC')
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
					$vehicles = DB::table('vehicle_types')
						->select('*')
						->get();

					$logs = DB::table('logistics_vehicle_assignment_logs')
						->select('*')
						->where('logistics_vehicle_assignment_logs.tenant_id', Auth::user()->tenant_id)
						->where('logistics_vehicle_assignment_logs.vehicle_id', $vehicle->id)
						->join('users', 'logistics_vehicle_assignment_logs.driver_id', '=', 'users.id')
//					->join('users', 'logistics_users.user_id', '=', 'users.id')
						->orderBy('logistics_vehicle_assignment_logs.id', 'DESC')->get();


					return view('backend.logistics.vehicle-details', [
						'vehicle'=>$vehicle,
						'drivers'=>$drivers,
						'logs'=>$logs,
						'renewals' => $renewals,
						'employees' => $employees,
						'renewal_schedules' => $renewal_schedules,
						'vehicles' => $vehicles,
						'maintenances' => $maintenances,
						'maintenance_schedules' => $maintenance_schedules]);
				}else{
					session()->flash("error", "<strong>Ooops!</strong> Vehicle not found.");
					return redirect()->route('logistics-vehicles');
				}

			endif;


			if($method == 'post'):

				if($request->post_type == 1):

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
					$this->renewSchedule->renewal_schedule_renew_date = $request->renewal_schedule_renew_date;
					$this->renewSchedule->renewal_schedule_user_id = $request->renewal_schedule_user_id;
					$this->renewSchedule->save();

					session()->flash("success", "<strong>Success!</strong> Renewal Schedule Registered.");
					$_route = 'logistics/view-vehicle/'.$slug;
					return redirect($_route);

				endif;

				if($request->post_type == 2):

					$check =   DB::table('maintenance_schedules')
						->select('*')
						->where(['maintenance_schedule_type_id' => $request->maintenance_schedule_type_id,
							'maintenance_schedule_vehicle_id' => $request->maintenance_schedule_vehicle_id])

						->first();

					if(!empty($check)):
						$this->maintenanceSchedule = $this->maintenanceSchedule::find($check->id);
					endif;

						$date = date_create_from_format('d/m/Y', $request->maintenance_schedule_due_date);

						$date = date_format($date, 'Y-m-d');

					$this->maintenanceSchedule->tenant_id = Auth::user()->tenant_id;
					$this->maintenanceSchedule->maintenance_schedule_type_id = $request->maintenance_schedule_type_id;
					$this->maintenanceSchedule->maintenance_schedule_vehicle_id = $request->maintenance_schedule_vehicle_id;
					$this->maintenanceSchedule->maintenance_schedule_date = $request->maintenance_schedule_date;
					$this->maintenanceSchedule->maintenance_schedule_user_id = $request->maintenance_schedule_user_id;
					$this->maintenanceSchedule->maintenance_schedule_due_date = $date;


				$this->maintenanceSchedule->save();

					session()->flash("success", "<strong>Success!</strong> Maintenance Schedule Registered.");
					$_route = 'logistics/view-vehicle/'.$slug;
					return redirect($_route);

				endif;

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
					->where('logistics_vehicles.status',  '=', 1)
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

		public function maintenanceSchedule(Request $request){

			$method = strtolower($request->method());
			if($method == 'get'):
				$maintenance_schedules = DB::table('maintenance_schedules')
					->select( '*')
					->join('maintenance_types', 'maintenance_schedules.maintenance_schedule_type_id', '=', 'maintenance_types.id')
					->join('logistics_vehicles', 'maintenance_schedules.maintenance_schedule_vehicle_id', '=', 'logistics_vehicles.id')
					->join('users', 'maintenance_schedules.maintenance_schedule_user_id', '=', 'users.id')
					->orderBy('maintenance_schedules.maintenance_schedule_date', 'asc')
					->where('logistics_vehicles.status',  '=', 1)
					->get();

				return view('backend.logistics.maintenance-schedule', ['maintenance_schedules' => $maintenance_schedules]);


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

		public function maintenanceScheduleCalender(Request $request){

			$method = strtolower($request->method());
			if($method == 'get'):
				$maintenance_schedules = DB::table('maintenance_schedules')
					->select( '*')
					->join('maintenance_types', 'maintenance_schedules.maintenance_schedule_type_id', '=', 'maintenance_types.id')
					->join('logistics_vehicles', 'maintenance_schedules.maintenance_schedule_vehicle_id', '=', 'logistics_vehicles.id')
					->join('users', 'maintenance_schedules.maintenance_schedule_user_id', '=', 'users.id')
					->orderBy('maintenance_schedules.maintenance_schedule_date', 'asc')
					->where('logistics_vehicles.status',  '=', 1)
					->get();

				return view('backend.logistics.maintenance-schedule-calendar', ['maintenance_schedules' => $maintenance_schedules]);


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

		public function storeDriver(Request $request){
			//return dd($request->all());
			$this->validate($request,[
				'user_id'=>'required',
				'means_of_identification'=>'required',

			]);

			if(!empty($request->file('moi_attachment'))){
				$extension = $request->file('moi_attachment');
				$extension = $request->file('moi_attachment')->getClientOriginalExtension();
				$size = $request->file('moi_attachment')->getSize();
				$dir = 'assets/uploads/logistics/';
				$filename = uniqid().'_'.time().'_'.date('Y-m-d').'.'.$extension;
				$request->file('moi_attachment')->move(public_path($dir), $filename);
			}else{
				$filename = '';
			}

			$check = $this->drivers::where('user_id', $request->user_id)->first();

			if(empty($check)):

				$this->drivers->user_id = $request->user_id;
				$this->drivers->registered_by = Auth::user()->id;
				$this->drivers->tenant_id = Auth::user()->tenant_id;
				$this->drivers->type_of_identification = $request->means_of_identification;
				$this->drivers->license_date = $request->license_date;
				$this->drivers->attachment = $filename;

				$this->drivers->save();

				session()->flash("success", "<strong>Success!</strong> New driver registered.");
				return redirect()->route('logistics-drivers');
			else:

				$this->drivers = $check;
				$this->drivers->user_id = $request->user_id;
				$this->drivers->registered_by = Auth::user()->id;
				$this->drivers->tenant_id = Auth::user()->tenant_id;
				$this->drivers->type_of_identification = $request->means_of_identification;
				$this->drivers->license_date = $request->license_date;
				$this->drivers->attachment = $filename;
				$this->drivers->save();
				session()->flash("success", "<strong>Success!</strong> Driver Updated.");
				return redirect()->route('logistics-drivers');
			endif;
		}

		public function maintenanceType(Request $request){
			$method = strtolower($request->method());
			if($method == 'get'):
				$maintenances = DB::table('maintenance_types')
					->select('*')
					->get();

				return view('backend.logistics.maintenance_type', ['maintenances' => $maintenances]);

			endif;

			if($method == 'post'):
				if(isset($request->id)):
					$this->maintenanceType = $this->maintenanceType::find($request->id);
				endif;
				$this->maintenanceType->tenant_id = Auth::user()->tenant_id;
				$this->maintenanceType->maintenance_type_name = $request->maintenance_type_name;
				$this->maintenanceType->maintenance_type_interval = $request->maintenance_type_interval;
				$this->maintenanceType->save();

				session()->flash("success", "<strong>Success!</strong> New Maintenance Registered.");
				return redirect()->route('maintenance-type');

			endif;
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
//        $vehicleTaken = LogisticsUser::where('vehicle_id', $request->vehicle)
//                                                ->where('tenant_id', Auth::user()->tenant_id)
//                                                ->first();

			$vehicleTaken = LogisticsVehicle::where('id', $request->vehicle)
				->where('tenant_id', Auth::user()->tenant_id)
				->first();

			$driverTaken = LogisticsVehicle::where('assigned_to', $request->driver)
				->where('tenant_id', Auth::user()->tenant_id)
				->first();


			if(!empty($vehicleTaken->assigned_to)):

				if(!empty($driverTaken)):

					$driverTaken->assigned_to = null;
					$driverTaken->save();

				endif;
				$vehicleTaken->assigned_to = null;
				$vehicleTaken->save();

			endif;
			$newVehicle = LogisticsVehicle::where('id', $request->vehicle)->where('tenant_id', Auth::user()->tenant_id)->first();
			$newVehicle->assigned_to = $request->driver;
			$newVehicle->save();
//
//        if(!empty($vehicleTaken)){
//	        $vehicleTaken->vehicle_id = null; //take vehicle from driver
//	        $vehicleTaken->save();
//	        #Assign to new person
//	        $newDriver = LogisticsUser::where('tenant_id', Auth::user()->tenant_id)
//		        ->where('id', $request->driver)
//		        ->first();
//	        $newDriver->vehicle_id = $request->vehicle;
//	        $newDriver->save();
//        }
//        else{
//            $newDriver = LogisticsUser::where('tenant_id', Auth::user()->tenant_id)
//                                    ->where('id', $request->driver)
//                                    ->first();
//            $newDriver->vehicle_id = $request->vehicle;
//            $newDriver->save();
//        }
//
//        if(!empty($driverTaken)){
//            #Vehicle
//            $driverTaken->assigned_to = null; //vehicle not assigned to anyone
//            $driverTaken->save();
//        }else{
//            #vehicle
//            $newVehicle = LogisticsVehicle::where('id', $request->vehicle)->where('tenant_id', Auth::user()->tenant_id)->first();
//            $newVehicle->assigned_to = $request->driver;
//            $newVehicle->save();
//        }
			$log = new LogisticsVehicleAssignmentLog;
			$log->tenant_id = Auth::user()->tenant_id;
			$log->vehicle_id = $request->vehicle;
			$log->driver_id = $request->driver;
			$log->reason = $request->reason;
			$log->assigned_by = Auth::user()->id;
			$log->employee_id = $request->assign_employee;
			$log->due_date = $request->due_date;
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
