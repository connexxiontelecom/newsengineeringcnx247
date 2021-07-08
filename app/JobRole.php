<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobRole extends Model
{
    //department-job-role relationship
    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }


	public function getTenantJobRoles(){
		return JobRole::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'ASC')->get();
	}

	public function setNewJobRole(Request $request){
		$role = new JobRole();
		$role->tenant_id = Auth::user()->tenant_id;
		$role->department_id = $request->department;
		$role->role_name = $request->job_role;
		$role->role_description = $request->role_description;
		$role->save();
	}

	public function updateJobRole(Request $request){
		$role = JobRole::find($request->role);
		$role->tenant_id = Auth::user()->tenant_id;
		$role->department_id = $request->department;
		$role->role_name = $request->job_role;
		$role->role_description = $request->role_description;
		$role->save();
	}
}
