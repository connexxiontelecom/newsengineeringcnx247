<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Client;
use App\ClientMessaging as ClientMessagingModel;
use Auth;

class ClientMessaging extends Mailable
{
    use Queueable, SerializesModels;
    public $message, $client;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Client $client, ClientMessagingModel $message)
    {
        $this->message = $message;
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->tenant->email,Auth::user()->tenant->company_name)
        ->subject($this->message->subject)
        ->markdown('mails.crm.client.email');
    }
}
