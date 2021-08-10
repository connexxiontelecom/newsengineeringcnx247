<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilestoneSubmissionAttachment extends Model
{
    //

	/*
	 * Use-case methods
	 */
	public function uploadFiles(Request $request, $milestone)
	{
		if ($request->hasFile('attachments')) {
			foreach($request->attachments as $attachment){
				$extension = $attachment->getClientOriginalExtension();
				$size = $attachment->getSize();
				$filename = uniqid() .'_' .date('Ymd') . '.' . $extension;
				$dir = 'assets/drive/';
				$attachment->move(public_path($dir), $filename);
				$file = new MilestoneSubmissionAttachment();
				$file->milestone_submission_id = $milestone->id;
				$file->attachment = $filename;
				$file->save();
			}
		}

	}
}
