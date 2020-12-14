<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use Auth;
class onBoardEmployee extends Mailable
{
    public $user, $password;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $password)
    {
        $this->user = $user;
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
        ->subject('Congratulations! Job Offer from '.Auth::user()->tenant->company_name)
        ->markdown('mails.employee.onboard-employee');
    }
}
