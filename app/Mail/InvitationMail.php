<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Invitation;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $invitation;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@cnx247.com','CNX247 ERP Solution')
        ->subject('Invitation')
        ->markdown('mails.invite.invitation-mail');
    }
}
