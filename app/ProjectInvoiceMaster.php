<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectInvoiceMaster extends Model
{
    //
    public function getClient(){
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function getCreatedBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getProjectInvoiceDetail(){
        return $this->hasMany(ProjectInvoiceDetail::class, 'invoice_id');
    }
}
