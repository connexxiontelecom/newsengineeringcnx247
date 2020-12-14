<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //error 404
    public function error404(){
        return view('backend.errors.404');
    }
}
