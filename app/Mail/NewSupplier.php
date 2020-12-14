<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Supplier;
use Auth;
class NewSupplier extends Mailable
{
    public $supplier, $password;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Supplier $supplier, $password)
    {
        $this->supplier = $supplier;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->tenant->email,Auth::user()->tenant->company_name)
        ->subject('Goodnews! You were registered as supplier to'.Auth::user()->tenant->company_name)
        ->markdown('mails.procurement.supplier.new-supplier');
    }
}
