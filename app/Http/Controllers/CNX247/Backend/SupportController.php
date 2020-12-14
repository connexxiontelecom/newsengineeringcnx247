<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use App\TicketCategory;
use Auth;


class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ticket(){
        return view('backend.crm.support.ticket');
    }
    public function ticketHistory(){
        return view('backend.crm.support.ticket-index');
    }

    public function viewTicket($slug){
        return view('backend.crm.support.view-ticket');
    }

    public function adminTicketIndex(){
        return view('backend.crm.support.admin.index');
    }
    public function newTicketCategory(Request $request){
        $this->validate($request,[
            'category_name'=>'required'
        ]);
        $category = new TicketCategory;
        $category->name = $request->category_name;
        $category->save();
        return response()->json(['message'=>'Success! New category saved.'], 200);
    }
}
