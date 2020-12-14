<?php

namespace App\Http\Controllers\CNX247\Backend;

//require_once(__DIR__ . '/vendor/autoload.php');
//Import Facade classes you are going to use here
//For example, if you need to use Customer, add
//use QuickBooksOnline\API\Facades\Customer;

use QuickBooksOnline\API\Core\ServiceContext;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\PlatformService\PlatformService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Purchase;
use QuickBooksOnline\API\Data\IPPPurchase;
use QuickBooksOnline\API\QueryFilter\QueryMessage;
use QuickBooksOnline\API\ReportService\ReportService;
use QuickBooksOnline\API\ReportService\ReportName;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuickBooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * Connection configuration
    */
    public function apiConnection(){
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => env('QUICKBOOKS_CLIENT_ID'),
            'ClientSecret' =>  env('QUICKBOOKS_CLIENT_SECRET'),
            'RedirectURI' => 'http://localhost:8080/callback.php',
            'scope' => 'com.intuit.quickbooks.accounting',
            'baseUrl' => "development"
        ));
        return $dataService;
    }

    /*
    * Connect to QuickBooks
    */
    public function connectToQuickBooks(){
        session_start();
            $dataService = DataService::Configure(array(
                'auth_mode' => 'oauth2',
                'ClientID' => env('QUICKBOOKS_CLIENT_ID'),
                'ClientSecret' => env('QUICKBOOKS_CLIENT_SECRET'),
                'RedirectURI' => 'http://127.0.0.1:8000/connect-to-quickbooks',
                //'RedirectURI' => 'https://developer.intuit.com/v2/OAuth2Playground/RedirectUrl',
                'scope' => "com.intuit.quickbooks.accounting",
                'baseUrl' => "https://sandbox-quickbooks.api.intuit.com"
            ));
            $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
            $authorizationCodeUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();
            $_SESSION['authUrl'] = $authorizationCodeUrl;

        //set the access token using the auth object
        if (isset($_SESSION['sessionAccessToken'])) {
            $accessToken = $_SESSION['sessionAccessToken'];
            $accessTokenJson = array('token_type' => 'bearer',
                'access_token' => $accessToken->getAccessToken(),
                'refresh_token' => $accessToken->getRefreshToken(),
                'x_refresh_token_expires_in' => $accessToken->getRefreshTokenExpiresAt(),
                'expires_in' => $accessToken->getAccessTokenExpiresAt()
            );
            $dataService->updateOAuth2Token($accessToken);
            $oauthLoginHelper = $dataService -> getOAuth2LoginHelper();
            $CompanyInfo = $dataService->getCompanyInfo();
        }
        return view('backend.quickbooks.connect', 
        ['authUrl'=>$_SESSION['authUrl'],
        'accessTokenJson'=>$accessTokenJson['access_token'] ?? ''
        ]);
    }

    /*
    * Make API call
    */
    public function makeAPICall(){

    }


}
