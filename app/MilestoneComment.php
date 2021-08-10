<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilestoneComment extends Model
{
    //
	public function getUser(){
		return $this->belongsTo(User::class, 'user_id');
	}



	/*
	 * Use-case methods
	 */
	public function setNewMilestoneComment(Request $request){
		$comment = new MilestoneComment();
		$comment->user_id = Auth::user()->id;
		$comment->project_id = $request->m_project;
		$comment->milestone_id = $request->m_milestone;
		$comment->comment = $request->m_comment;
		$comment->save();
	}
}
