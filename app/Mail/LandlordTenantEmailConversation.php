<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\LandlordTenantConversation;

class LandlordTenantEmailConversation extends Mailable
{
    use Queueable, SerializesModels;
    public $conversation;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(LandlordTenantConversation $conversation)
    {
        $this->conversation = $conversation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@cnx247.com',config('app.name'))
        ->subject($this->subject)
        ->markdown('mails.tenant.landlordtenantemailconversation');
    }
}
