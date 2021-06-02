<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueryNotify extends Model
{
    //

	public function getQuery(){
		return $this->hasMany(QueryEmployee::class, 'id');
	}
}
