<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\ModuleManager;
use App\TermsNCondition;
use App\PrivacyPolicy;
use App\User;
use App\Theme;
use App\Faq;
use Auth;
use Image;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * Load Roles  view
    */
    public function roles(){
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('backend.admin.roles', ['roles'=>$roles]);
    }
    /*
    * Load edit Role  view
    */
    public function editRole($id){
        $role = Role::find($id);
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('backend.admin.edit-role',
        ['roles'=>$roles,
        'role'=>$role
        ]);
    }

    /*
    * Register new role
    */
    public function newRole(Request $request){
        $this->validate($request,[
            'role_name'=>'required|unique:roles,name'
        ]);
        Role::create(['name'=>$request->role_name, 'type'=>$request->type]);
        session()->flash("success", "<strong>Success!</strong> Role saved.");
        return redirect()->back();
    }
    /*
    * save role changes
    */
    public function saveRoleChanges(Request $request){
        $this->validate($request,[
            'role_name'=>'required|unique:roles,name'
        ]);
        $role = Role::find($request->roleId);
        $role->name = $request->role_name;
        $role->type = $request->type;
        $role->save();
        session()->flash("success", "<strong>Success!</strong> Role changes saved.");
        return redirect()->route('roles');
    }
    /*
    * Load Permission view
    */
    public function permissions(){
        $permissions = Permission::orderBy('name', 'ASC')->get();
        $modules = ModuleManager::orderBy('module_name', 'ASC')->get();
        return view('backend.admin.permissions', ['permissions'=>$permissions, 'modules'=>$modules]);
    }
    /*
    * Load edit Permission view
    */
    public function editPermission($id){
        $permissions = Permission::orderBy('name', 'ASC')->get();
        $permission = Permission::find($id);
        $modules = ModuleManager::orderBy('module_name', 'ASC')->get();
        return view('backend.admin.edit-permission',
        ['permissions'=>$permissions,
        'modules'=>$modules,
        'permission'=>$permission
        ]);
    }

    /*
    * edit permission
    */
    public function savePermissionChanges(Request $request){
        $this->validate($request,[
            'permission_name'=>'required|unique:permissions,name',
            'module'=>'required',
            'permissionId'=>'required'
        ]);
        $edit = Permission::find($request->permissionId);
        $edit->name = $request->permission_name;
        $edit->module = $request->module;
        $edit->save();
        session()->flash("success", "<strong>Success!</strong> Permission changes saved.");
        return redirect()->route('permissions');
    }

    /*
    * Register new permission
    */
    public function newPermission(Request $request){
        $this->validate($request,[
            'permission_name'=>'required|unique:permissions,name',
            'module'=>'required'
        ]);
        Permission::create(['name'=>$request->permission_name, 'module'=>$request->module]);
        session()->flash("success", "<strong>Success!</strong> Permission saved.");
        return redirect()->back();
    }

    /*
    * Assign permission [view]
    */
    public function assignRoleToPermission($id){
        $role = Role::find($id);
        $modules = ModuleManager::orderBy('module_name', 'ASC')->get();
        return view('backend.admin.assign-permission',
        [
        'role'=>$role,
        'modules'=>$modules
        ]);
    }

    /*
    * Assign permission [store]
    */
    public function storeRolePermission(Request $request){
        $role = Role::find($request->role);
        $role->syncPermissions($request->permission);
        session()->flash("success", "<strong>Success!</strong> Permissions assigned to role.");
        return back();
    }
    /*
    * Revoke permission [store]
    */
    public function revokeRolePermission(Request $request){
        $role = Role::find($request->role);
        $role->revokePermissionTo($request->permission);
        session()->flash("success", "<strong>Success!</strong> Permissions revoked.");
        return back();
    }

    /*
    * Module manager
    */
    public function moduleManager(){
        $modules = ModuleManager::orderBy('module_name', 'ASC')->get();
        return view('backend.admin.module-manager', ['modules'=>$modules]);
    }
    /*
    * Register new Module
    */
    public function newModule(Request $request){

        $this->validate($request,[
            'module_name'=>'required|unique:module_managers,module_name'
        ]);
        $module = new ModuleManager;
        $module->module_name = $request->module_name;
        $module->slug = Str::slug($request->module_name, '-');
        $module->save();
        session()->flash("success", "<strong>Success!</strong> Module registered.");
        return redirect()->back();
    }

    /*
    * Landlord terms and conditions
    */
    public function termsAndConditions(){
        $terms = TermsNCondition::first();
        return view('backend.admin.terms-n-conditions', ['terms'=>$terms]);
    }

    public function showEditTermsForm($id){
        $terms = TermsNCondition::find($id);
        return view('backend.admin.edit-terms-n-conditions', ['terms'=>$terms]);
    }

    public function editTermsAndConditions(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'terms'=>'required'
        ]);
        $terms = TermsNCondition::find($request->id);
        $terms->terms = $request->terms;
        $terms->edited_by = Auth::user()->id;
        $terms->save();
        session()->flash("success", "<strong>Success!</strong> Terms and conditions updated.");
        return redirect()->route('terms-n-conditions');
    }
    public function privacyPolicy(){
        $privacy = PrivacyPolicy::first();
        return view('backend.admin.privacy-policy', ['privacy'=>$privacy]);
    }

    public function showEditPrivacyPolicyForm($id){
        $policy = PrivacyPolicy::find($id);
        return view('backend.admin.edit-privacy-policy', ['policy'=>$policy]);
    }

    public function editPrivacyPolicy(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'privacy_policy'=>'required'
        ]);
        $policy = PrivacyPolicy::find($request->id);
        $policy->privacy_policy = $request->privacy_policy;
        $policy->edited_by = Auth::user()->id;
        $policy->save();
        session()->flash("success", "<strong>Success!</strong> Privacy policy updated.");
        return redirect()->route('privacy-policy');
    }

    public function themeGallery(){
        $themes = Theme::orderBy('theme_name', 'ASC')->get();
        return view('backend.admin.themes.index', ['themes'=>$themes]);
    }

    public function themeGalleryUpload(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'attachment'=>'required|image'
        ]);
        if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension();
            $size = $request->file('attachment')->getSize();
            $dir = 'assets/uploads/themes/';
            $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }
        $theme = new Theme;
        $theme->theme = $filename;
        $theme->theme_name = $request->name;
        $theme->color_scheme =  $request->scheme == 1 ? '#8B9198' : '#FFFFFF';
        $theme->save();
        $themeId = $theme->id;
        if($request->custom == 'yes'){
            $user = User::find(Auth::user()->id);
            $user->active_theme = $themeId;
            $user->save();
        }
        if($theme){
            return response()->json(['message'=>'Success! Theme uploaded'], 200);
        }else{
            return response()->json(['error'=>'Ooops! We could not upload theme. Try again.'], 400);
        }

    }

    public function accessFaqs(){
        $faqs = Faq::orderBy('id', 'DESC')->get();
        return view('backend.admin.faqs.index', ['faqs'=>$faqs]);
    }

    public function storeFaq(Request $request){
        $this->validate($request,[
            'question'=>'required',
            'answer'=>'required'
        ]);

        $faq = new Faq;
        $faq->answer = $request->answer;
        $faq->question = $request->question;
        $faq->category = $request->category;
        $faq->user_id = Auth::user()->id;
        $faq->save();

        if($faq){
            return response()->json(['message'=>'Success! New FAQ added.'],200);
        }else{
            return response()->json(['error'=>'Ooops! Could not add FAQ.'],400);
        }
    }
}
