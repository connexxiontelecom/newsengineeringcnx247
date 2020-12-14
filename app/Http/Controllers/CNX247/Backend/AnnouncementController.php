<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * Load activity stream index page
    */
    public function index(){
        return view('backend.workflow.announcement.announcement');
    }
}
