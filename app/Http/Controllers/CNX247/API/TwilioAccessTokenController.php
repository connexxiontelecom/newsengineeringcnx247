<?php

namespace App\Http\Controllers\CNX247\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
/* use TwilioRestClient;
   use TwilioJwtAccessToken;
   use TwilioJwtGrantsVideoGrant; */

class TwilioAccessTokenController extends Controller
{
    public function generateToken()
    {
        // Substitute your Twilio Account SID and API Key details
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $apiKeySid = env('TWILIO_API_KEY_SID');
        $apiKeySecret = env('TWILIO_API_KEY_SECRET');

        $identity = uniqid();

        // Create an Access Token
        $token = new AccessToken(
            $accountSid,
            $apiKeySid,
            $apiKeySecret,
            3600,
            $identity
        );

        // Grant access to Video
        $grant = new VideoGrant();
        $grant->setRoom('cool room');
        $token->addGrant($grant);

        // Serialize the token as a JWT
        return response()->json(['message'=>$token->toJWT()]);
    }
}
