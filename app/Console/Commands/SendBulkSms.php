<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Twilio\Rest\Client;
use App\BulkSms;
use Auth;

class SendBulkSms extends Command
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
    protected $description = 'Periodically send pending bulk SMS';

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
    {       $sid    = env( 'TWILIO_ACCOUNT_SID' );
            $token  = env( 'TWILIO_AUTH_TOKEN' );
            $twilio_number = env("TWILIO_NUMBER");
            $messages = BulkSms::where('status',0)->get();
            foreach($messages as $message){
                try{
                    $client = new Client( $sid, $token );
                    $client->messages->create("+2348032404359", 
                    ['from' => $twilio_number, 'body' => $message->message ]); 
                    $message->status = 1; //that is sent 
                    $message->delivered = 1; //that is delivered
                    $message->time_sent = date('h:i:s'); 
                    $message->save();
                    $this->info('Success! SMS sent.'); 
                }catch(Exception $e){
                    $message->status = 2; //that is failed
                    $message->save();
                }
                
            }

    }
}
