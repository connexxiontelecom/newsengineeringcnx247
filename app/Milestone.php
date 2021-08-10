<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Milestone extends Model
{
    //project-milestone relationship
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public function getMilestonePersons(){
    	return $this->hasMany(MilestoneResponsiblePerson::class, 'milestone_id', 'id');
		}

		public function getAllSubmissions(){
    	return $this->hasMany(MilestoneSubmission::class, 'milestone_id')->orderBy('id', 'DESC');
		}

		public function getMilestoneComments(){
    	return $this->hasMany(MilestoneComment::class, 'milestone_id');
		}


    /*
     *
     * Use-case methods
     */
	public function setNewMilestone(Request $request){
		$milestone = new Milestone();
		$milestone->title = $request->title;
		$milestone->due_date = $request->due_date;
		$milestone->description = $request->description;
		$milestone->tenant_id = Auth::user()->tenant_id;
		$milestone->user_id = Auth::user()->id;
		$milestone->post_id = $request->project;
		$milestone->save();
		return $milestone;
		//$message = Auth::user()->first_name.' created new project milestone with the project ID: '.$request->post_id;
		//$this->applog->setNewLog(Auth::user()->tenant_id, Auth::user()->id, $message);
	}

	public function updateMilestoneStatus(Request $request){
		$mile = Milestone::find($request->update_milestone);
		$mile->status = $request->milestone_status;
		$mile->date_updated = now();
		$mile->updated_by = Auth::user()->id;
		$mile->save();
	}
}
