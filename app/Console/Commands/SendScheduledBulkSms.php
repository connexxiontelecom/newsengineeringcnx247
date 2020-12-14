<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Twilio\Rest\Client;
use App\BulkSms;

class SendScheduledBulkSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:bulksms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will run a routine check on pending SMS. Then send or update status';

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
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_AUTH_TOKEN' );
        $twilio_number = env("TWILIO_NUMBER");
            
            /*$client = new Client( $sid, $token );
            $client->messages->create("+2348032404359", 
                ['from' => $twilio_number, 'body' => 'To ensure international standard compliance, use country code (+234)'] );*/
                
            
            //Get pending SMS
            $sms = BulkSms::where('status', 0)->get();
            foreach($sms as $message){
                try{
                    $client = new Client( $sid, $token );
                    $client->messages->create("+2348032404359", 
                    ['from' => $twilio_number, 'body' => $message->message ]); 
                    $message->status = 1; //that is sent 
                    $message->save();
                }catch(Exception $e){
                    $message->status = 2; //that is failed
                    $message->save();
                }
                
            }
            $this->info("Success! SMS sent");
    }
}
