<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SharedFile extends Model
{
    //
    public function originalFile(){
        return $this->hasMany(FileModel::class,'id', 'file_id');
    }
}
