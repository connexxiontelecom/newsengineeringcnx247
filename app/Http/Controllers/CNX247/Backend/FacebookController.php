<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;


class FacebookController extends Controller
{
    //constructor
    public function __construct(){
        $this->middleware('auth');
    }

    /*
    * Connect to Facebook
    */
    public function connect(){
        return view('backend.facebook.connect-to-facebook');
    }

    /*
    * Facebook timeline
    */
    public function facebookTimeline(){
        return view('backend.facebook.facebook-timeline');
    }


}
