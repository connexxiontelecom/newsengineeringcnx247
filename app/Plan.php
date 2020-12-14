<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
        //plan features

        public function planFeatures(){
            return $this->belongsTo(PlanFeature::class,'plan_id');
        }
}
