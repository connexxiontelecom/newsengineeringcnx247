<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;

class Dialer extends Component
{
    public $phone_number;
    public $call_button = "Call";
    public $call_progress;

    public function render()
    {
        return view('livewire.backend.dialer');
    }

    /*
    * When component is mounted
    */
    public function mount(){
      
    }

    /*
    * Append numbers
    */
    public function addNumber($number){
        if(strlen($this->phone_number) <= 13){
            $this->phone_number .= $number;
        }
    }

    /*
    * Delete number
    */
    public function delete(){
        if(strlen($this->phone_number) > 0){
            $this->phone_number = substr($this->phone_number, 0, -1);
        }
    }

    /*
    * Make call
    */
    public function makeCall(){
        //$this->call_button = "Dialing...";
        try{
            $client = new Client(
                getenv('TWILIO_ACCOUNT_SID'),
                getenv('TWILIO_AUTH_TOKEN'),
            );
            try{
                $client->calls->create(
                    $this->phone_number,
                    getenv('TWILIO_NUMBER'),
                    array("url"=>"http://demo.twilio.com/docs/voice.xml")
                );
                //$this->call_button = "Connected!";
                $this->call_progress = "Ringing...!";
                session()->flash('stage', $this->call_progress);
                $this->resetDialer();
            }catch(\Exception $e){
                $this->call_button = $e->getMessage();
            }
        }catch(ConfigurationException $e){
            $this->call_button = $e->getMessage();
        }
    }

    /*
    * Reset dialer
    */
    public function resetDialer(){
        $this->phone_number = "";
    }
}
