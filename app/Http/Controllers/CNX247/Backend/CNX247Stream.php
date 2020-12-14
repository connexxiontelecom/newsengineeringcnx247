<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Rest\Client;
use App\Cnx247stream as Cnx247Model;
use App\Cnx247StreamLog;
use Carbon\Carbon;
//use TwilioRestClient;
use Auth;
use Hash;

class CNX247Stream extends Controller
{   protected $sid;
    protected $token;
    protected $key;
    protected $secret;

    public function __construct()
    {
       $this->middleware('auth');
       $this->sid = env('TWILIO_ACCOUNT_SID');
       $this->token = env('TWILIO_AUTH_TOKEN');
       $this->key = env('TWILIO_API_KEY_SID');
       $this->secret = env('TWILIO_API_KEY_SECRET');
    }
    //index page
    public function index(){
        $now = Carbon::now();
        $myRooms = Cnx247Model::where('tenant_id', Auth::user()->tenant_id)->get();
        $thisMonth = Cnx247StreamLog::where('tenant_id', Auth::user()->tenant_id)
                            ->whereMonth('created_at', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->count();
        $lastMonth = Cnx247StreamLog::where('tenant_id', Auth::user()->tenant_id)
                            ->whereMonth('created_at', '=', $now->subMonth()->month)
                            ->count();

        $rooms = [];
        try {
            $client = new Client($this->sid, $this->token);
            $allRooms = $client->video->rooms->read([]);

             $rooms = array_map(function($room) {
                return $room->uniqueName;
             }, $allRooms);

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return view('backend.cnx247stream.index',
        ['rooms' => $rooms,
        'myRooms'=>$myRooms,
        'thisMonth'=>$thisMonth,
        'lastMonth'=>$lastMonth
        ]);
    }

    /*
    * Create a new room if not exist
    */
    public function createRoom(Request $request){
        $this->validate($request,[
            'roomName'=>'required|unique:cnx247streams,room_name'
        ]);
        $room = new Cnx247Model;
        $room->room_name = $request->roomName;
        $room->created_by = Auth::user()->id;
        $room->tenant_id = Auth::user()->tenant_id;
        $room->password = !empty($request->password) ? bcrypt($request->password) : '';
        $room->save();
        $client = new Client($this->sid, $this->token);

        $exists = $client->video->rooms->read([ 'uniqueName' => $request->roomName]);

        if (empty($exists)) {
            $client->video->rooms->create([
                'uniqueName' => $request->roomName,
                'type' => 'group',
                'recordParticipantsOnConnect' => false
            ]);

            \Log::debug("created new room: ".$request->roomName);
        }

        return redirect()->route('join-room', [
            'room_name' => $request->roomName
        ]);
    }

    /*
    * Join room
    */
    public function joinRoom($roomName){
        // A unique identifier for this user
         $identity = Auth::user()->first_name;
         //get room
        $room = Cnx247Model::where('room_name', $roomName)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($room->password) ){
            return view('backend.cnx247stream.security-check',['roomName'=>$roomName, 'identity'=>$identity]);
        }else{
                //Register log
                $log = new Cnx247StreamLog;
                $log->room_id = $room->id;
                $log->user_id = Auth::user()->id;
                $log->tenant_id = Auth::user()->tenant_id;
                $log->save();
                \Log::debug("joined with identity: $identity");
                $token = new AccessToken($this->sid, $this->key, $this->secret, 3600, $identity);

                $videoGrant = new VideoGrant();
                $videoGrant->setRoom($roomName);

                $token->addGrant($videoGrant);

                return view('backend.cnx247stream.livestreaming',
                [ 'accessToken' => $token->toJWT(),
                'roomName' => $roomName,
                'room'=>$room
                ]);
            }
        }

        /*
        * Security check
        */
        public function securityCheck(Request $request){
            $this->validate($request,[
                'roomName'=>'required',
                'identity'=>'required',
                'password'=>'required'
            ]);
            $room = Cnx247Model::where('room_name', $request->roomName)
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->first();
            if (Hash::check($request->password, $room->password)) {
                //Register log
                $log = new Cnx247StreamLog;
                $log->room_id = $room->id;
                $log->user_id = Auth::user()->id;
                $log->tenant_id = Auth::user()->tenant_id;
                $log->save();
                \Log::debug("joined with identity: $request->identity");
                $token = new AccessToken($this->sid, $this->key, $this->secret, 3600, $request->identity);

                $videoGrant = new VideoGrant();
                $videoGrant->setRoom($request->roomName);

                $token->addGrant($videoGrant);

                return view('backend.cnx247stream.livestreaming',
                [ 'accessToken' => $token->toJWT(),
                'roomName' => $request->roomName,
                'room'=>$room
                ]);
            }else{
                session()->flash("error", "<strong>Ooops!</strong> Password mis-match");
                return redirect()->back();
            }

        }

        /*
        * Delete room
        */
        public function deleteRoom($room_name){
            $room = Cnx247Model::where('room_name', $room_name)
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->first();
            $roomId = $room->id;

            if(!empty($room) ){
                $room->delete();
                $logs = Cnx247StreamLog::where('tenant_id', Auth::user()->tenant_id)
                                        ->where('room_id', $roomId)
                                        ->get();
                foreach($logs as $log){
                    $log->delete();
                }
                session()->flash("success", "<strong>Success!</strong> Room deleted.");
                return redirect()->back();
            }else{
                session()->flash("error", "<strong>Ooops!</strong> Something is not right. Please try again.");
                return redirect()->back();
            }
        }


}
