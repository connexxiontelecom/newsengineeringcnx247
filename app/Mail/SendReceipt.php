<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Receipt;
use Auth;

class SendReceipt extends Mailable
{
    public $receipt;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Receipt $receipt)
    {
        $this->receipt = $receipt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->tenant->email, Auth::user()->tenant->company_name)
        ->subject('Receipt')
        ->markdown('mails.receipt.send-receipt-mail');
    }
}
