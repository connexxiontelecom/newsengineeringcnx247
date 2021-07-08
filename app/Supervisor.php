<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Supervisor extends Model
{
    //user-supervisor relationship
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    //department-supervisor relationship
    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }
	public function getTenantSupervisors(){
		return Supervisor::where('tenant_id', Auth::user()->tenant_id)->orderBy('id','ASC')->get();
	}

	public function setNewSupervisor(Request $request){
		$supervisor = new Supervisor();
		$supervisor->tenant_id = Auth::user()->tenant_id;
		$supervisor->department_id = $request->department;
		$supervisor->user_id = $request->supervisor;
		$supervisor->save();
	}
	public function updateSupervisor(Request $request){
		$supervisor = Supervisor::find($request->position);
		$supervisor->tenant_id = Auth::user()->tenant_id;
		$supervisor->department_id = $request->department;
		$supervisor->user_id = $request->supervisor;
		$supervisor->save();
	}
}
