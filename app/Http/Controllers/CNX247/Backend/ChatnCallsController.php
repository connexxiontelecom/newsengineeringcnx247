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
use App\Events\NewMessage;
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
				//$this->showChatnCallsView();
				broadcast(new NewMessage($send));

				$title =  Auth::user()->first_name ." ". Auth::user()->surname;
				$this->ToSpecificUser($send->tenant_id, $title, $request->message, $request->receiver);

       /*  // pusher
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
        $pusher->trigger('my-channel', 'my-event', $data);*/
			return response()->json($send);
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

        return view('backend.chat.view.chat');
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


	/* 	public function chat(){
			return view('backend.chat.view.chat');
		} */

		public function initializeChat(){
			// get all users except the authenticated one
			$users = User::where('id', '!=', auth()->id())->where('tenant_id', Auth::user()->tenant_id)->get();
			$unreadIds = Message::select(\DB::raw('`from_id` as sender_id, count(`from_id`) as unread'))
            ->where('to_id', auth()->id())
						->where('is_read', 0)
						->where('tenant_id', Auth::user()->tenant_id)
            ->groupBy('from_id')
						->get();
			$users = $users->map(function($user) use ($unreadIds) {
							$userUnread = $unreadIds->where('sender_id', $user->id)->first();

							$user->unread = $userUnread ? $userUnread->unread : 0;

							return $user;
					});

			$auth_user = Auth::user();
			return response()->json(['users'=>$users, 'auth_user'=>$auth_user],200);
		}


		public function chatWith($id){
			$my_id = Auth::user()->id;
			Message::where('from_id', $id)->where('to_id', $my_id)->update(['is_read' => 1]);
			$messages = Message::where(function($q) use ($id) {
						$q->where('from_id', Auth::user()->id);
						$q->where('to_id', $id);
						$q->where('status', 0); //not cleared messages
						})->orWhere(function($q) use ($id) {
								$q->where('from_id', $id);
								$q->where('to_id', Auth::user()->id);
						})
						->get();
			$auth_user = Auth::user();
			$selected_user = User::where('tenant_id', Auth::user()->tenant_id)->where('id', $id)->first();
			return response()->json(['messages'=>$messages, 'auth_user'=>$auth_user, 'selected_user'=>$selected_user],200);
		}


		public function clearMessages($id){
			$my_id = Auth::user()->id;
			$messages = Message::where(function ($query) use ($id, $my_id) {
											$query->where('from_id', $id)->where('to_id', $my_id);
									})->oRwhere(function ($query) use ($id, $my_id) {
											$query->where('from_id', $my_id)->where('to_id', $id);
									})->get();
			foreach($messages as $message){
				$message->status = 1; //cleared
				$message->save();
			}

			return response()->json(['message'=>'Done!'], 200);
		}

		public function filterContact($search){
			//$users = User::where('id', '!=', auth()->id())->where('tenant_id', Auth::user()->tenant_id)->get();
			$filtered_users = User::where('tenant_id', Auth::user()->tenant_id)
														->where('id', '!=', auth()->id())
														->where('first_name', 'like', "%{$search}%")
														->get();

				$auth_user = Auth::user();
				return response()->json(['users'=>$filtered_users, 'auth_user'=>$auth_user],200);



		}





		public function pushtoToken($token, $title, $body, $userId, $tenantId)
    {
        //$token, $title, $body, $userId, $tenantId

        $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        $data = array("clickaction" => "FLUTTERNOTIFICATIONCLICK", "user" => $userId, "tenant_id" => $tenantId);

        //Creating the notification array.
        $notification = array('title' => $title, 'body' => $body);

        //This array contains, the token and the notification. The 'to' attribute stores the token.
        $arrayToSend = array('to' =>$token, 'notification' => $notification, 'data' => $data);

        //Generating JSON encoded string form the above array.
        $json = json_encode($arrayToSend);

        $url = "https://fcm.googleapis.com/fcm/send";
        //Setup headers:
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=AAAAQ6WOcsM:APA91bGx5qqTvsZoFYEMdLiNuM-DlH509sszesHzH5IdW-_OqyRNAw8UrT1VfimR0ITKpF4sJCK7GOoeI0zPYvhkQu4gmow783ZG77Qrj8seV_0QgWkkCBGZ7oSSzdVoTKIckOusTI8x';

        //Setup curl, add headers and post parameters.
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
       // print($result);

        //Send the request
        //curl_exec($ch);

        //Close request
        curl_close($ch);
		}



		public function ToAllUsers($tenant_id, $title, $body, $userId="32")
		{
			$token = "/topics/all";
			$this->pushtoToken($token, $title, $body, $userId, $tenant_id);
		}


		public function ToSpecificUser($tenant_id, $title, $body, $userId)
		{
			$users = User::where('users.tenant_id', $tenant_id)->where('users.id', $userId)->get();
			foreach($users as $user)
			{
					 $token= $user['device_token'];
					 if($token !=null && !empty($token))
						{
							$this->pushtoToken($token, $title, $body, $userId, $tenant_id);
						}
			}
		}











}
