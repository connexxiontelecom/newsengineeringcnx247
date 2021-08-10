<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilestoneResponsiblePerson extends Model
{
    //

public function getUser(){
	return $this->belongsTo(User::class, 'user_id');
}



	/*
	 * Use-case methods
	 */
	public function setNewMilestoneResponsiblePerson(Request $request, $assign_to, $milestone){
		$milestoneresponsibel = new MilestoneResponsiblePerson();
		$milestoneresponsibel->user_id = $assign_to;
		$milestoneresponsibel->project_id = $request->project;
		$milestoneresponsibel->milestone_id = $milestone->id;
		$milestoneresponsibel->tenant_id = Auth::user()->tenant_id;
		$milestoneresponsibel->save();
	}

	public function getUserById($user_id){
		return User::find($user_id);
	}
}
