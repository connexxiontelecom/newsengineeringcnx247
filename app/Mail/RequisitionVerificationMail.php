<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Post;
use Auth;
class RequisitionVerificationMail extends Mailable
{
    public $user, $request, $code;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Post $request, $code)
    {
        $this->code = $code;
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->tenant->email,Auth::user()->tenant->company_name)
        ->subject('Requisition Authentication')
        ->markdown('mails.workflow.verification');
    }
}
