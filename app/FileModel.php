<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileModel extends Model
{
    //
    public function fileOwner(){
        return $this->belongsTo(User::class,'owner');
    }

    public function sharedWith(){
        return $this->belongsTo(User::class, 'shared_with');
    }

}
