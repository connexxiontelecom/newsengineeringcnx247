<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@connexxiongroup.com','CNX247 ERP Solution')
        ->subject('Password Reset')
        ->markdown('mails.user.password-reset');
    }
}
