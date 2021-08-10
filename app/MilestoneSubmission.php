<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilestoneSubmission extends Model
{
    //

	public function getAllMilestoneReportAttachments(){
		return $this->hasMany(MilestoneSubmissionAttachment::class, 'milestone_submission_id');
	}



	/*
	 * Use-case methods
	 */
	public function setNewMilestoneReport(Request $request){
		$report = new MilestoneSubmission();
		$report->milestone_id = $request->milestone;
		$report->user_id = Auth::user()->id;
		$report->note = $request->leave_note ?? '';
		$report->slug = substr(sha1(time()),29,40);
		$report->save();
		return $report;
	}

}
