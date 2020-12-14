<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\InvitationMail;
use App\Invitation;

class SendInvitationMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:invitation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command sends out pending invitations.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sendInvite = Invitation::where('status', 0)->get();
        foreach ($sendInvite as $invite) {
            \Mail::to($invite)->send(new InvitationMail($invite));
            $invite->status = 1;
            $invite->update();
        }
        return "Message sent!";
    }
}
