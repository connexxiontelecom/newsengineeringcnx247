<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Plan;
use App\PlanFeature;
use App\ModuleManager;
use App\Currency;
use Auth;
use DB;
class PlansnFeaturesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = PlanFeature::orderBy('price', 'ASC')->get();
        return view('backend.admin.plan-features.plans', ['plans'=>$plans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = Currency::all();
        #Plans come from role table
        $plans = Role::where('type', 0)->get();
        return view('backend.admin.plan-features.create',
        [
         'currencies'=>$currencies,
         'plans'=>$plans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'plan_name'=>'required',
            'duration'=>'required',
            'amount'=>'required',
            'currency'=>'required',
            'emails'=>'required',
            'sms'=>'required',
            'call_duration'=>'required',
            'number_of_users'=>'required',
            'storage_size'=>'required',
            'cnxstream_duration'=>'required',
            'description'=>'required',
        ]);
        $plan = new PlanFeature;
        $plan->currency_id = $request->currency;
        $plan->plan_id = $request->plan_name;
        $plan->duration = $request->duration;
        $plan->price = $request->amount;
        $plan->emails = $request->emails;
        $plan->sms = $request->sms;
        $plan->calls = $request->call_duration;
        $plan->team_size = $request->number_of_users;
        $plan->storage_size = $request->storage_size;
        $plan->stream = $request->cnxstream_duration;
        $plan->description = $request->description;
        $plan->slug = substr(sha1(time()), 19,40);
        $plan->save();
        session()->flash("success", "<strong>Success!</strong> Plan changes saved.");
        return redirect()->route('plans-n-features');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($url)
    {
        $plan = PlanFeature::where('slug', $url)->first();
        if(!empty($plan) ){
            $permissionObj = DB::table('role_has_permissions')
            ->select('permission_id')
            ->where('role_id', $plan->plan_id)
            ->distinct()
            ->get();
            $permissionIds = array();
            foreach ($permissionObj as $permit) {
                array_push($permissionIds,$permit->permission_id);
            }
            #Use permission IDs to get module Obj
            $moduleObj = Permission::select('module')->whereIn('id', $permissionIds)->distinct()->get();
            #Convert $moduleObj to array
            $moduleIds = array();
            foreach($moduleObj as $mod){
                array_push($moduleIds, $mod->module);
            }
            #Get list of modules for this tenant
            $modules = ModuleManager::whereIn('id', $moduleIds)->orderBy('module_name', 'ASC')->get();
            return view('backend.admin.plan-features.view', ['plan'=>$plan, 'modules'=>$modules]);
        }else{
            return redirect()->route('404');
        }
    }

    public function edit($id)
    {
        $currencies = Currency::all();
        #Plans come from role table
        $plan = PlanFeature::where('id', $id)->first();
        $plans = Role::where('type', 0)->get();
        return view('backend.admin.plan-features.edit',
        [
         'currencies'=>$currencies,
         'plan'=>$plan,
         'plans'=>$plans
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'plan_name'=>'required',
            'duration'=>'required',
            'amount'=>'required',
            'currency'=>'required',
            'emails'=>'required',
            'sms'=>'required',
            'call_duration'=>'required',
            'number_of_users'=>'required',
            'storage_size'=>'required',
            'cnxstream_duration'=>'required',
            'description'=>'required',
        ]);
        $plan = PlanFeature::where('id', $request->planId)->first();
        $plan->currency_id = $request->currency;
        $plan->plan_id = $request->plan_name;
        $plan->duration = $request->duration;
        $plan->price = $request->amount;
        $plan->emails = $request->emails;
        $plan->sms = $request->sms;
        $plan->calls = $request->call_duration;
        $plan->team_size = $request->number_of_users;
        $plan->storage_size = $request->storage_size;
        $plan->stream = $request->cnxstream_duration;
        $plan->description = $request->description;
        $plan->save();
        session()->flash("success", "<strong>Success!</strong> Plan changes saved.");
        return redirect()->route('plans-n-features');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
