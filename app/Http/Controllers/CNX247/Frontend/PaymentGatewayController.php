<?php

namespace App\Http\Controllers\CNX247\Frontend;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Mail\onBoardEmployee;
use Paystack;
use App\Plan;
use App\PlanFeature;
use Carbon\Carbon;
use App\User;
use App\TransactionReference;
use App\ModuleManager;
use App\Membership;
use App\Tenant;
use App\Industry;
use Auth;
use DB;

class PaymentGatewayController extends Controller
{
    public function createSite($timestamp, $plan){
        $chosen_plan = PlanFeature::where('slug', $plan)->first();
        $industries = Industry::orderBy('industry', 'ASC')->get();
        $permissionObj = DB::table('role_has_permissions')
        ->select('permission_id')
        ->where('role_id', $chosen_plan->plan_id)
        ->distinct()
        ->get();
        $permissionIds = array();
        foreach ($permissionObj as $permit) {
            array_push($permissionIds,$permit->permission_id);
        }
        $moduleObj = Permission::select('module')->whereIn('id', $permissionIds)->distinct()->get();
        $moduleIds = array();
        foreach($moduleObj as $mod){
            array_push($moduleIds, $mod->module);
        }
        $modules = ModuleManager::whereIn('id', $moduleIds)->orderBy('module_name', 'ASC')->get();
        return view('auth.create-site',
        ['chosen_plan'=>$chosen_plan,
        'modules'=>$modules,
        'industries'=>$industries
        ]);
    }
    public function startTrial(){
        $industries = Industry::orderBy('industry', 'ASC')->get();
        return view('auth.start-trial',
        ['industries'=>$industries]);
    }

		public function registerTrial(Request $request){
				$this->validate($request,[
					'site_address'=>'required',
					'company_name'=>'required',
					'email'=>'required|unique:users,email',
					'password'=>'required',
					'industry'=>'required',
					'use_case'=>'required',
					'first_name'=>'required',
					'phone'=>'required',
					'team_size'=>'required',
					'terms'=>'required',
					'role'=>'required'
			]);
						$tenant_id = null;

						//register new tenant
						$latest_tenant = Tenant::orderBy('id', 'DESC')->first();
						if(!empty($latest_tenant)){
								$tenant_id = $latest_tenant->tenant_id + rand(100,999);

						}else{
								$tenant_id = rand(100, 999);
						}
						$current = Carbon::now();
						$start = now();
						$end =  $current->addDays(14);//14 days trial
						$key = "key_".substr(sha1(time()),21,40 );
						$plan = 21; //trial ID
						$tenant = new Tenant;
						$tenant->company_name = $request->company_name;
						$tenant->site_address = $request->site_address;
						#$tenant->password = $password;
						$tenant->use_case = $request->use_case;
						$tenant->role = $request->role;
						$tenant->team_size = $request->team_size;
						$tenant->industry_id = $request->industry;
						$tenant->phone = $request->phone;
						$tenant->email = $request->email;
						$tenant->plan_id = $plan;
						$tenant->date_format_id = 1;
						$tenant->lang_id = 1;
						$tenant->currency_id = 1;
						$tenant->logo = 'logo.png';
						$tenant->favicon = 'favicon.png';
						$tenant->currency_position_id = 1;
						$tenant->start = $start;
						$tenant->end = $end;
						$tenant->tenant_id = $tenant_id;
						$tenant->active_sub_key = $key;
						$tenant->slug = substr(sha1(time()),29,40 );
						$tenant->save();

						#membership
						$member = new Membership;
						$member->tenant_id = $tenant_id;
						$member->plan_id = $plan;
						$member->sub_key = $key;
						$member->status = 1; //active;
						$member->start_date = now();
						$member->end_date = $end;
						$member->save();
						#proceed to register new user account
						$user = new User;
						$user->first_name = $request->first_name ?? 'No First Name';
						$user->password = bcrypt($request->password);
						$user->email = $request->email;
						$user->tenant_id = $tenant_id; //new tenantID
						$user->verified = 1; //account verified
						$user->url = substr(sha1(time()),29,40 );
						$user->verification_link = substr(sha1(time()), 25,40);
						$user->save();
						$user->assignRole('Human Resource');
						//\Mail::to($user)->send(new onBoardEmployee($user, $password));
						session()->flash("success", "<strong>Success!</strong> Trial registration done.");
						return redirect()->route('signin');

		}
    /*
    *Proceed to make payment
    */
    public function proceedToPay(Request $request){
      //return dd($request->all());
        $this->validate($request,[
                'site_address'=>'required',
                'company_name'=>'required',
                'email'=>'required|unique:users,email',
                'password'=>'required',
                'industry'=>'required',
                'use_case'=>'required',
                'first_name'=>'required',
                'phone'=>'required',
                'team_size'=>'required',
                'terms'=>'required',
                'role'=>'required',
                'amount'=>'required'
            ]);
            return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /*
    * Payment callback
    */
    public function handleGatewayCallback(){
        #Get payment details
        $paymentDetails = Paystack::getPaymentData();
        $metadata = json_decode($paymentDetails['data'] ['metadata'][0], true);
        $current = Carbon::now();
        if(Auth::check() ){
            $key = "key_".substr(sha1(time()),21,40 );
            $tenant = Tenant::where('tenant_id', Auth::user()->tenant_id)->first();
            $tenant->start = now();
            $tenant->end =  $current->addDays($metadata['duration']);
            $tenant->active_sub_key = $key;
            $tenant->plan_id = $metadata['plan'];
            $tenant->save();
            #membership
            $member = new Membership;
            $member->tenant_id = Auth::user()->tenant_id;
            $member->plan_id = $metadata['plan'];
            $member->sub_key = $key;
            $member->status = 1; //active;
            $member->start_date = now();
            $member->end_date = $current->addDays($metadata['duration']);
            $member->save();
            #Transaction
            $trans = new TransactionReference;
            $trans->status = $paymentDetails['data']['status'];
            $trans->reference = $paymentDetails['data']['reference'];
            $trans->amount = $paymentDetails['data']['amount'];
            $trans->paid_at = $paymentDetails['data']['paid_at'];
            $trans->created_at = $paymentDetails['data']['created_at'];
            $trans->channel = $paymentDetails['data']['channel'];
            $trans->currency = $paymentDetails['data']['currency'];
            $trans->ip_address = $paymentDetails['data']['ip_address'];
            $trans->bin = $paymentDetails['data']['authorization']['bin'];
            $trans->last4 = $paymentDetails['data']['authorization']['last4'];
            $trans->exp_month = $paymentDetails['data']['authorization']['exp_month'];
            $trans->exp_year = $paymentDetails['data']['authorization']['exp_year'];
            $trans->card_type = $paymentDetails['data']['authorization']['card_type'];
            $trans->bank = $paymentDetails['data']['authorization']['bank'];
            $trans->country_code = $paymentDetails['data']['authorization']['country_code'];
            $trans->brand = $paymentDetails['data']['authorization']['brand'];
            $trans->account_name = $paymentDetails['data']['authorization']['account_name'];
            $trans->tenant_id = Auth::user()->tenant_id; //new tenantID
            $trans->save();
            session()->flash("success", "<strong>Congratulations!</strong> Subscription renewed.");
            return redirect()->route('our-pricing');
        }else{

            $company_name = $metadata['company_name'];
            $site_address = $metadata['site_address'];
            $password = $metadata['password'];
            $use_case = $metadata['use_case'];
            $role = $metadata['role'];
            $team_size = $metadata['team_size'];
            $industry = $metadata['industry'];
            $phone = $metadata['phone'];
            $email = $metadata['email'];
            $duration = $metadata['duration'];
            $plan = $metadata['plan'];
            $first_name = $metadata['first_name'];

            $current = Carbon::now();
            $end_date = $current->addDays($duration);
            $tenant_id = null;
            $active_sub_key = "key_".substr(sha1(time()),21,40 );
            if($paymentDetails['data']['status'] == 'success'){
                //register new tenant
                $latest_tenant = Tenant::orderBy('id', 'DESC')->first();
                if(!empty($latest_tenant)){
                    $tenant_id = $latest_tenant->tenant_id + rand(100,999);

                }else{
                    $tenant_id = rand(100, 999);
                }
                    $tenant = new Tenant;
                    $tenant->company_name = $company_name;
                    $tenant->site_address = $site_address;
                    #$tenant->password = $password;
                    $tenant->use_case = $use_case;
                    $tenant->role = $role;
                    $tenant->team_size = $team_size;
                    $tenant->industry_id = $industry;
                    $tenant->phone = $phone;
                    $tenant->email = $email;
                    $tenant->plan_id = $plan;
                    $tenant->date_format_id = 1;
                    $tenant->lang_id = 1;
                    $tenant->currency_id = 1;
                    $tenant->logo = 'logo.png';
                    $tenant->favicon = 'favicon.png';
                    $tenant->currency_position_id = 1;
                    $tenant->start = now();
                    $tenant->end = $end_date;
                    $tenant->tenant_id = $tenant_id;
                    $tenant->active_sub_key = $active_sub_key;
                    $tenant->slug = substr(sha1(time()),29,40 );
                    $tenant->save();

                    #membership
                    $member = new Membership;
                    $member->tenant_id = $tenant_id;
                    $member->plan_id = $plan;
                    $member->sub_key = $active_sub_key;
                    $member->status = 1; //active;
                    $member->start_date = now();
                    $member->end_date = $end_date;
                    $member->save();
                    #proceed to register new user account
                    $user = new User;
                    $user->first_name = $first_name ?? 'No First Name';
                    $user->password = bcrypt($password);
                    $user->email = $email;
                    $user->tenant_id = $tenant_id; //new tenantID
                    $user->verified = 0; //account verified
                    $user->url = substr(sha1(time()),29,40 );
                    $user->verification_link = substr(sha1(time()), 25,40);
                    $user->save();
                    $user->assignRole('Human Resource');
                    //\Mail::to($user)->send(new onBoardEmployee($user, $password));
                    #register transaction reference
                    $trans = new TransactionReference;
                    $trans->status = $paymentDetails['data']['status'];
                    $trans->reference = $paymentDetails['data']['reference'];
                    $trans->amount = $paymentDetails['data']['amount'];
                    $trans->paid_at = $paymentDetails['data']['paid_at'];
                    $trans->created_at = $paymentDetails['data']['created_at'];
                    $trans->channel = $paymentDetails['data']['channel'];
                    $trans->currency = $paymentDetails['data']['currency'];
                    $trans->ip_address = $paymentDetails['data']['ip_address'];
                    $trans->bin = $paymentDetails['data']['authorization']['bin'];
                    $trans->last4 = $paymentDetails['data']['authorization']['last4'];
                    $trans->exp_month = $paymentDetails['data']['authorization']['exp_month'];
                    $trans->exp_year = $paymentDetails['data']['authorization']['exp_year'];
                    $trans->card_type = $paymentDetails['data']['authorization']['card_type'];
                    $trans->bank = $paymentDetails['data']['authorization']['bank'];
                    $trans->country_code = $paymentDetails['data']['authorization']['country_code'];
                    $trans->brand = $paymentDetails['data']['authorization']['brand'];
                    $trans->account_name = $paymentDetails['data']['authorization']['account_name'];
                    $trans->tenant_id = $tenant_id; //new tenantID
                    $trans->save();
                    return view('auth.payment-success',
                    ['name'=>$first_name]);
            }else{
                return "Failed";
            }
        }

    }
}
