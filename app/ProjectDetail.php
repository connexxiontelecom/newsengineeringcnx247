<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    public function getCreatedBy(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function getPostedBy(){
        return $this->belongsTo(User::class, 'posted_by');
    }
    public function getClient(){
        return $this->belongsTo(Client::class, 'client_id');
    }
}
