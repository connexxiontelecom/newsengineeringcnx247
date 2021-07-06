<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Department extends Model
{



	/*
	 * Use-case methods
	 */
	public function getTenantDepartments(){
		return Department::where('tenant_id', Auth::user()->tenant_id)->orderBy('department_name', 'ASC')->get();
	}
}
