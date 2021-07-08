<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Department extends Model
{



	/*
	 * Use-case methods
	 */
	public function getTenantDepartments(){
		return Department::where('tenant_id', Auth::user()->tenant_id)->orderBy('department_name', 'ASC')->get();
	}

	public function setNewDepartment(Request $request){
		$department = new Department();
		$department->department_name = $request->department_name;
		$department->tenant_id = Auth::user()->tenant_id;
		$department->save();
	}
	public function updateDepartment(Request $request){
		$department = Department::find($request->department);
		$department->department_name = $request->department_name;
		$department->tenant_id = Auth::user()->tenant_id;
		$department->save();
	}
}
