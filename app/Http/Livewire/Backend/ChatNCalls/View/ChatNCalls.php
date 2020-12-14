<?php

namespace App\Http\Livewire\Backend\ChatNCalls\View;

use Livewire\Component;
use App\Notifications\ChatNotification;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Jwt\ClientToken;
use Twilio\Rest\Client;
use Pusher\Pusher;
use App\User;
use Carbon\Carbon;
use Cache;
use App\Message;
use Auth;
use DB;

class ChatNCalls extends Component
{
    public $users;
    public $friend = []; //selected user
    public $messages = null;
    public $message = '';
    public $selectedUserId = null;
    public $phone_number = 2348032404359;
    public function render()
    {
        return view('livewire.backend.chat-n-calls.view.chat-n-calls');
    }
    public function mount(){
        $this->getUsers();
    }


    /*
    *
    */
    public function getUsers(){
       $this->users = User::where('account_status', 1)
                            ->where('verified', 1)
                            ->where('id', '!=', Auth::user()->id)
                            ->where('tenant_id', Auth::user()->tenant_id)
                            ->orderBy('first_name', 'ASC')
                            ->get();
/*         foreach ($this->users as $user) {
            if (Cache::has('user-is-online-' . $user->id))
                echo $user->name . " is online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
            else
                echo $user->name . " is offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
        } */
       /* $this->users = DB::select("select users.id, users.first_name, users.surname, users.avatar,
                        users.email, users.tenant_id, count(is_read) as unread
                        FROM users
                        LEFT JOIN messages
                        ON users.id = messages.from_id
                        AND is_read = 0
                        AND messages.to_id = ".Auth::user()->id. "
                        WHERE users.id != ".Auth::user()->id."
                        WHERE users.tenant_id = ".Auth::user()->tenant_id."
                        GROUP BY users.id, users.first_name, users.surname, users.avatar, users.email, users.tenant_id");*/
    }

    /*
    * Select user
    */
    public function getConversation($id){

        $this->messages = Message::where('from_id', Auth::id())->where('to_id', $id)
                                ->orWhere('from_id', $id)->where('to_id', Auth::id())
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->get();
        $this->selectedUserId = $id;
/*         $this->friend = User::select('first_name', 'surname', 'avatar', 'position', 'mobile')
                        ->where('id', $id)
                        ->where('tenant_id', Auth::user()->tenant_id)->first(); */
    }

    /*
    *Send message
    */
    public function sendMessage(){
        $this->validate([
            'message'=>'required'
        ]);
        $message = new Message;
        $message->to_id = $this->selectedUserId;
        $message->from_id = Auth::user()->id;
        $message->message = $this->message;
        $message->tenant_id = Auth::user()->tenant_id;
        $message->save();
        //notify this user
        $user = User::find($this->selectedUserId);
        $user->notify(new ChatNotification($message));
        $options = array(
                'cluster' => 'eu',
                'useTLS' => true
            );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $data = ['from'=>Auth::user()->id, 'to'=>$this->selectedUserId];
        $pusher->trigger('my-channel', 'my-event', $data);
        $this->message = '';
        $this->getConversation($this->selectedUserId);
    }

    /*
    * Make call
    */
    public function makeCall(){
        try{
            $client = new Client(
                getenv('TWILIO_ACCOUNT_SID'),
                getenv('TWILIO_AUTH_TOKEN'),
            );

            /* $forPage = $request->input('forPage');
            $applicationSid = getenv('TWILIO_ACCOUNT_SID');
            $this->clientToken->allowClientOutgoing($applicationSid);

            if ($forPage === route('dashboard', [], false)) {
                $this->clientToken->allowClientIncoming('support_agent');
            } else {

            } */
            try{
                $client->calls->create(
                    $this->phone_number,
                    getenv('TWILIO_NUMBER'),
                    //array("url"=>"http://demo.twilio.com/docs/voice.xml") https://demo.twilio.com/welcome/voice/
                    array("url"=>"https://handler.twilio.com/twiml/EH18a8f6e92ab777a827278cefbf03f768")
                );
                session()->flash('stage', 'Ringing...');
            }catch(\Exception $e){
                //$this->call_button = $e->getMessage();
            }
        }catch(ConfigurationException $e){
            //$this->call_button = $e->getMessage();
        }
    }
}
