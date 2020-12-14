<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\EmailCampaign;
use App\Tenant;
use App\Mail\SendEmailCampaign as SendEmailCampaignMail;
class SendEmailCampaign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emailcampaign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command check for pending email campaigns then send...';

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
        $emails = EmailCampaign::where('status', 0)->get();
        if(!empty($emails)){
            foreach($emails as $email){
                $tenant = Tenant::where('tenant_id', $email->tenant_id)->first();
                \Mail::to($email)->send(new SendEmailCampaignMail($email, $tenant));
                $email->status = 1;
                $email->save();
            }
            $this->info('Success! Email campaign sent.');
        }
    }
}
