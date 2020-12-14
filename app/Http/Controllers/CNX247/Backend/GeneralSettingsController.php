<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tenant;
use Auth;

class GeneralSettingsController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){
        return view('backend.settings.index');
    }

    /*
    * Change company assets
    */
    public function changeCompanyAssets(Request $request){
        $this->validate($request,[
            'logo'=>'required',
            'favicon'=>'required'
        ]);
        #Logo
        if($request->logo){
    	    $logo_filename = time().'.'.explode('/', explode(':', substr($request->logo, 0, strpos($request->logo, ';')))[1])[1];
    	    //logo
    	    \Image::make($request->logo)/* ->resize(52, 82) */->save(public_path('assets/images/company-assets/logos/').$logo_filename);
    	}
        if($request->favicon){
    	    $favicon_filename = time().'.'.explode('/', explode(':', substr($request->favicon, 0, strpos($request->favicon, ';')))[1])[1];
    	    //favicon
    	    \Image::make($request->favicon)/* ->resize(32, 32) */->save(public_path('assets/images/company-assets/favicons/').$favicon_filename);
    	}
       if(\File::exists(public_path('assets/images/company-assets/logos/'.Auth::user()->tenant->logo))){
            \File::delete(public_path('assets/images/company-assets/logos/'.Auth::user()->tenant->logo));
          }
        if(\File::exists(public_path('assets/images/company-assets/favicons/'.Auth::user()->tenant->favicon))){
            \File::delete(public_path('assets/images/company-assets/favicons/'.Auth::user()->tenant->favicon));
          }
        $tenant = Tenant::where('tenant_id',Auth::user()->tenant_id)->first();
        $tenant->logo = $logo_filename;
        $tenant->favicon = $favicon_filename;
        $tenant->save();
        return response()->json(['message'=>'Success! Company logo and favicon changed.']);

    }
}
