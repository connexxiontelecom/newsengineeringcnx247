<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use App\BulkSms;
use App\PhoneGroup;
use Auth;

class BulkSmsController extends Controller
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
        $sms = BulkSms::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        $clients = Client::where('tenant_id', Auth::user()->tenant_id)->orderBy('first_name', 'ASC')->get();
        return view('backend.crm.bulk-sms.index', ['clients'=>$clients, 'sms'=>$sms]);
    }

    public function create(){
        $groups = PhoneGroup::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.crm.bulk-sms.compose-sms', ['groups'=>$groups]);
    }
    /*
    * Process SMS
    */
    public function sendBulkSms(Request $request){
        
        if(is_null($request->phone_numbers)){
            $this->validate($request,[
                'phone_groups'=>'required',
                'sender_id'=>'required',
                'text_message'=>'required'
            ]);
        }
        $contacts = null;
        $new_numbers = null;
        if(!empty($request->phone_groups)){
            for($c = 0; $c<count($request->phone_groups); $c++){
                $number = PhoneGroup::where('id', $request->phone_groups[$c])->where('tenant_id', Auth::user()->tenant_id)->first();
                $contacts .= $number->phone_numbers;
            }
        }
        $new_numbers = $request->phone_numbers;
        $newNumbersArray = preg_split("/,\s*/",$new_numbers); 
        $contactArray = preg_split("/,\s*/",$contacts); 
        $newPhoneNumbersArray = array_merge($newNumbersArray, $contactArray);
        $filteredContacts = array_values(array_filter($newPhoneNumbersArray));
        //return dd($filteredContacts);
        $unique = array_unique($filteredContacts);
        $batch_id = substr(sha1(time()), 11,40);
        for($i=0; $i<count($unique); $i++){
            $sms = new BulkSms;
            $sms->tenant_id = Auth::user()->tenant_id;
            $sms->mobile_no = $unique[$i];
            $sms->message = $request->text_message;
            $sms->status = 0; //pending
            $sms->batch_id = $batch_id;
            $sms->sender_id = $request->sender_id ?? 'via CNX247';
            $sms->save();
        }
        session()->flash("success", "<strong>Success!</strong> SMS queued. It will be sent shortly.");
        return redirect()->route('bulk-sms');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newPhoneGroup(){
        return view('backend.crm.bulk-sms.new-phone-group');
    }
    public function phoneGroups()
    {
        $groups = PhoneGroup::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.crm.bulk-sms.phone-groups', ['groups'=>$groups]);
    }
    public function storePhoneGroup(Request $request)
    {
        $this->validate($request,[
            'phone_group_name'=>'required',
            'phone_numbers'=>'required'
        ]);
        $phone_numbers = preg_split("/,\s*/",$request->phone_numbers); 
        $unique = array_unique($phone_numbers);
        $group = new PhoneGroup;
        $group->phone_group_name = $request->phone_group_name;
        $group->phone_numbers = implode(', ', $unique);
        $group->tenant_id = Auth::user()->tenant_id;
        $group->added_by = Auth::user()->id;
        $group->slug = substr(sha1(time()), 12,40);
        $group->save();
        session()->flash("success", "<strong>Success!</strong> Phone group created.");
        return redirect()->route('phone-groups');
    }
    public function updatePhoneGroup(Request $request)
    {
        $this->validate($request,[
            'phone_group_name'=>'required',
            'phone_numbers'=>'required' 
        ]);
        $phone_numbers = preg_split("/,\s*/",$request->phone_numbers); 
        $unique = array_unique($phone_numbers);
        $group = PhoneGroup::where('id', $request->id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $group->phone_group_name = $request->phone_group_name;
        $group->phone_numbers = implode(', ', $unique);
        $group->tenant_id = Auth::user()->tenant_id;
        $group->added_by = Auth::user()->id;
        $group->slug = substr(sha1(time()), 12,40);
        $group->save();
        session()->flash("success", "<strong>Success!</strong> Phone group updated.");
        return redirect()->route('phone-groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPhoneGroup($slug)
    {
        $group = PhoneGroup::where('tenant_id', Auth::user()->tenant_id)->where('slug', $slug)->first();
        if(!empty($group)){
            return view('backend.crm.bulk-sms.view-phone-group', ['group'=>$group]);
        }
    }
    public function deletePhoneGroup($slug)
    {
        $group = PhoneGroup::where('tenant_id', Auth::user()->tenant_id)->where('slug', $slug)->first();
        if(!empty($group)){
            $group->delete();
            session()->flash("success", "<strong>Success!</strong> Phone group deleted.");
            return redirect()->route('phone-groups');
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Phone group not found.");
            return redirect()->route('phone-groups');
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
