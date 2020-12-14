<?php

namespace App\Http\Controllers\CNX247\Backend;

use Twilio\Exceptions\ConfigurationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\TwiML\VoiceResponse;
use Twilio\Jwt\ClientToken;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\Rest\Client;
use Pusher\Pusher;
use App\User;
use App\Message;
use Auth;
use DB;

class ChatnCallsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * Load conversations with this user
    */
    public function getConversation($user_id){
        $my_id = Auth::id();
        // Make all unread message
        Message::where(['from_id' => $user_id, 'to_id' => $my_id])->update(['is_read' => 1]);
        $user = User::find($user_id);
        $conversations = Message::where(function ($query) use ($user_id, $my_id) {
                                    $query->where('from_id', $user_id)->where('to_id', $my_id);
                                })->oRwhere(function ($query) use ($user_id, $my_id) {
                                    $query->where('from_id', $my_id)->where('to_id', $user_id);
                                })->get();
        return view('backend.chat.common._conversations', ['conversations'=>$conversations, 'user'=>$user]);
    }
    /*
    * Send message
    */
    public function sendChat(Request $request){
        $this->validate($request, [
            'message'=>'required',
            'receiver'=>'required'
        ]);
        $send = new Message;
        $send->message = $request->message;
        $send->to_id = $request->receiver;
        $send->from_id = Auth::user()->id;
        $send->tenant_id = Auth::user()->tenant_id;
        $send->save();
        $this->showChatnCallsView();

        // pusher
        $options = array(
            'cluster' => 'eu'
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $data = ['from' => Auth::user()->id, 'to' => $request->receiver]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);

    }
    /*
    *
    */
    public function sendAttachment(Request $request){
        $this->validate($request,[
            'attachment'=>'required'
        ]);
        #share attachment
        if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'chat_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }

/*         if($request->attachment){
            $filename = 'chat_'.time().'.'.explode('/', explode(':', substr($request->attachment, 0, strpos($request->attachment, ';')))[1])[1];
            //share attachment
            //$file->move(base_path('\modo\images'),$file->getClientOriginalName());
            \Image::make($request->attachment)->resize(52, 82)->save(public_path('assets/uploads/attachments/').$filename);
        } */
        $message = new Message;
        $message->to_id = $request->to;
        $message->from_id = Auth::user()->id;
        $message->attachment = $filename;
        $message->tenant_id = Auth::user()->tenant_id;
        $message->save();
    }
    /*
    * Chat-n-calls view
    */
    public function showChatnCallsView(){
        $users = DB::select("select users.id, users.first_name, users.avatar,
        users.email, users.surname, users.mobile, users.position, count(is_read) as unread,
        messages.created_at as message_date
        FROM users
        LEFT  JOIN  messages
        ON users.id = messages.from_id
        AND is_read = 0
        AND messages.to_id = " . Auth::id() . "
        WHERE users.id != " . Auth::id() . "
        AND users.tenant_id = " .Auth::user()->tenant_id. "
        GROUP BY  messages.created_at, users.id, users.first_name, users.avatar, users.email, users.surname, users.mobile, users.position
        ORDER BY messages.created_at DESC ");

        return view('backend.chat.view.chat-n-calls', ['users'=>$users]);
    }

    public function newToken(Request $request){
        $forPage = $request->forPage;
        $sid = getenv('TWILIO_ACCOUNT_SID');
        $token =  getenv('TWILIO_AUTH_TOKEN');
        if ($forPage === route('dashboard', [], false)) {
            $this->clientToken->allowClientIncoming('support_agent');
        } else {

        }
    }

    /*
    * Make call
    */
    public function makeCall(Request $request){
        // Get form input
        $userPhone = $request->phoneNumber;
        $encodedSalesPhone = urlencode(str_replace(' ','',$request->phoneNumber));
        // Set URL for outbound call - this should be your public server URL
        $host = config('app.url');//parse_url(Request::url(), PHP_URL_HOST);

        // Create authenticated REST client using account credentials in
        // <project root dir>/.env.php
        $client = new Client(
            getenv('TWILIO_ACCOUNT_SID'),
            getenv('TWILIO_AUTH_TOKEN')
        );

        try {
           $call = $client->calls->create(
                $request->phoneNumber,
                getenv('TWILIO_NUMBER'),
                array(
                    //"twiml" => "<Response><Say>Ahoy there!</Say></Response>"
                    "url" => "http://$host/outbound/$encodedSalesPhone"//"http://demo.twilio.com/docs/voice.xml"//"http://$host/outbound/$encodedSalesPhone"
                )
            );
        } catch (Exception $e) {
            // Failed calls will throw
            return $e;
        }

        // return a JSON response
        return array('message' => $call);
    }

    public function newCall(Request $request)
    {
        $response = new VoiceResponse();
        $callerIdNumber = getenv('TWILIO_NUMBER');

        $dial = $response->dial(null, ['callerId'=>$callerIdNumber]);
        $phoneNumberToDial = $request->input('phoneNumber');

        if (isset($phoneNumberToDial)) {
            $dial->number($phoneNumberToDial);
        } else {
            $dial->client('support_agent');
        }

        return $response;
    }
}
