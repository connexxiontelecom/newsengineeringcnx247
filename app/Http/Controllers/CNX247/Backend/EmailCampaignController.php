<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use App\EmailCampaign;
use Auth;

class EmailCampaignController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = EmailCampaign::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        $clients = Client::where('tenant_id', Auth::user()->tenant_id)->orderBy('first_name', 'ASC')->get();
        return view('backend.crm.email-campaign.index', ['clients'=>$clients, 'emails'=>$emails]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.crm.email-campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'receivers'=>'required',
            'subject'=>'required',
            'content'=>'required'
        ]);
        $emails = preg_split("/,\s*/",$request->receivers);;
        for($i = 0; $i<count($emails); $i++){
            $campaign = new EmailCampaign;
            $campaign->tenant_id = Auth::user()->tenant_id;
            $campaign->sender_id = Auth::user()->id;
            $campaign->status = 0; //in progress
            $campaign->email = $emails[$i];
            $campaign->subject = $request->subject;
            $campaign->content = $request->content;
            $campaign->tracking_id = substr(sha1(time()), 40-$i < 0 ? $i+1 : 19-$i,40);
            $campaign->read_unread = 0; //unread
            $campaign->save();
        }
        session()->flash("success", "<strong>Success!</strong> Campaign queued for sending...");
        return redirect()->route('email-campaigns');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mail = EmailCampaign::where('tracking_id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($mail)){
            return view('backend.crm.email-campaign.view', ['mail'=>$mail]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Mail not found.");
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
