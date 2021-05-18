<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
class StartTrial extends Mailable
{
    use Queueable, SerializesModels;
		public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
				return $this->from(config('app.email'),config('app.name'))
				->subject('CNX247 ERP Solution Trial ')
				->markdown('mails.user.start-trial');
    }
}
