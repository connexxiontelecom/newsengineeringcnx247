<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Invoice;
use App\InvoiceItem;
use App\Client;
use Auth;

class SendInvoice extends Mailable
{   public $invoice;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->tenant->email, Auth::user()->tenant->company_name)
        ->subject('Invoice')
        ->markdown('mails.invoice.send-invoice-mail');
    }
}
