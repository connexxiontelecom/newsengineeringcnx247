<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\LogisticsUser;
use Auth;
class NewDriver extends Mailable
{
    use Queueable, SerializesModels;
    public $driver, $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(LogisticsUser $driver, $password)
    {
        $this->driver = $driver;
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
        ->subject('Goodnews! You were registered as driver to '.Auth::user()->tenant->company_name)
        ->markdown('mails.logistics.driver.new-driver');
    }
}
