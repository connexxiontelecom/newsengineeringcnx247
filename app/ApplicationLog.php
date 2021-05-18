<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationLog extends Model
{
    //


	public function getUser(){
		return $this->belongsTo(User::class, 'user_id');
	}


	/*
	 * Use-case methods
	 */

	public function setNewLog($tenant, $user_id, $activity){
			$log = new ApplicationLog();
			$log->tenant_id = $tenant;
			$log->user_id = $user_id;
			$log->activity = $activity;
			$log->log_date = now();
			$log->save();
	}
}
