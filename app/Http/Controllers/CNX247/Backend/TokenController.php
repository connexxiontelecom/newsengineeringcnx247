<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Jwt\ClientToken;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\TwiML\VoiceResponse;
use Twilio\Rest\Client;
use App\User;
use Auth;

class TokenController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Create a new capability token
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Create a new capability token
     *
     * @return \Illuminate\Http\Response
     */
    public function newToken(Request $request)
    {
        //$forPage = $request->input('forPage');
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $applicationSid = env('TWILIO_APPLICATION_SID');
        $apiKey = env('TWILIO_API_KEY_SID');
        $apiSecret = env('TWILIO_API_KEY_SECRET');
        $identity = "CNX247_ERP_Solution";
        $access = new AccessToken(
            $accountSid,
            $apiKey,
            $apiSecret,
            3600,
            $identity
        );
        $voiceGrant = new VoiceGrant();
        $voiceGrant->setOutgoingApplicationSid($applicationSid);
        // Optional: add to allow incoming calls
        $voiceGrant->setIncomingAllow(true);
        // Add grant to token
        $access->addGrant($voiceGrant);
        $token = $access->toJWT();
        return response()->json(['token' => $access]);
    }

    public function newCall(Request $request)
    {
        $response = new VoiceResponse();
        $callerIdNumber = env('TWILIO_NUMBER');

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
