<?php

namespace App\Http\Controllers\CNX247\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Plan;
use App\Faq;
use App\PlanFeature;
use App\ModuleManager;
use DB;

class BaseController extends Controller
{
    #load homepage
    public function homepage(){
        $permissionObj = DB::table('role_has_permissions')
        ->select('permission_id')
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

			$plans = PlanFeature::orderBy('price', 'ASC')->get();
        #Get list of modules for this tenant
        $modules = ModuleManager::whereIn('id', $moduleIds)->orderBy('module_name', 'ASC')->get();
        //$plans = Role::where('type', 0)->get();
        return view('frontend.index', ['plans'=>$plans]);
    }


    /*
    * Assign Permission to employee
    */
    public function assignPermissionToEmployee($url){
        #User to assign permission
        $user = User::where('url',$url)->first();
        #Get plans/role for this tenant
        #The role table is used for pricing plan also. What differentiate role from price plan is TYPE
        $role = Role::find(Auth::user()->tenant->plan_id)->first();
        #role_has_permissions [get permission ID]
        $permissionObj = DB::table('role_has_permissions')
                            ->select('permission_id')
                            ->distinct()
                            ->where('role_id', Auth::user()->tenant->plan_id)->get();

        #Convert $permissionObj to array
        $permissionIds = array();
        foreach ($permissionObj as $per) {
            array_push($permissionIds,$per->permission_id);
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
        return view('backend.hr.assign-permission-to-user',
        ['user'=>$user,
        'modules'=>$modules
        ]);
    }

    /*
    * Pricing
    */
    public function pricing(){
        $plans = PlanFeature::orderBy('price', 'ASC')->get();
        return view('frontend.pricing', ['plans'=>$plans]);
    }
    /*
    * support
    */
    public function support(){
        return view('frontend.support');
    }

    public function product(){
    	return view('frontend.product');
		}

    public function contact_us(){
    	return view('frontend.contact-us');
		}

		public function human_resource(){
    	return view('frontend.product.human-resource');
		}

	public function accounting(){
		return view('frontend.product.accounting');
	}

		public function crm(){
    	return view('frontend.product.crm');
		}

    /*
    * faqs
    */
    public function faqs(){
        $faqs = Faq::orderBy('id', 'DESC')->get();
        return view('frontend.faqs', ['faqs'=>$faqs]);
		}


}
