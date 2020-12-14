<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\LandlordTenantEmailConversation;
use App\TermsNCondition;
use App\PrivacyPolicy;
use App\Tenant;
use Carbon\Carbon;
use App\TransactionReference;
use App\Membership;
use App\LandlordTenantConversation;
use Auth;
class TenantController extends Controller
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
        $tenants = Tenant::orderBy('id', 'DESC')->paginate(10);
        $now = Carbon::now();
        $overall = Tenant::count();
        $thisYear = Tenant::whereYear('created_at', date('Y'))
                        ->count();
        $thisMonth = Tenant::whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))
                        ->count();
        $thisWeek = Tenant::whereBetween('created_at', [$now->startOfWeek()->format('Y-m-d H:i'), $now->endOfWeek()->format('Y-m-d H:i')])
                        ->count();
        $lastMonth = Tenant::whereMonth('created_at', '=', $now->subMonth()->month)
                        ->count();
        #Par
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);

        $lastWeek = Tenant::whereBetween('created_at', [$start_week, $end_week])
                        ->count();
        $yesterday = Tenant::whereDay('created_at', $now->yesterday())
                        ->count();
        $today = Tenant::whereDay('created_at', $now->today())
                        ->count();

        return view('backend.admin.tenants.index',
        ['tenants'=>$tenants,
        'overall'=>$overall,
        'thisYear'=>$thisYear,
        'thisMonth'=>$thisMonth,
        'thisWeek'=>$thisWeek,
        'lastMonth'=>$lastMonth
        ]);
    }

    public function financials(){
        $now = Carbon::now();
        $overall = TransactionReference::sum('amount');
        $thisYear = TransactionReference::whereYear('created_at', date('Y'))
                        ->sum('amount');
        $thisMonth = TransactionReference::whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))
                        ->sum('amount');
        $thisWeek = TransactionReference::whereBetween('created_at', [$now->startOfWeek()->format('Y-m-d H:i'), $now->endOfWeek()->format('Y-m-d H:i')])
                        ->sum('amount');
        $lastMonth = TransactionReference::whereMonth('created_at', '=', $now->subMonth()->month)
                        ->sum('amount');
        $weekly = TransactionReference::selectRaw("sum(amount) as amount, sum(bin) as amt, DATE_FORMAT(created_at, '%b')  as month")
                        //->where('transaction_id', $url)
                        ->groupBy('month')
                        ->get();
        #Par
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);

        $lastWeek = TransactionReference::whereBetween('created_at', [$start_week, $end_week])
                        ->sum('amount');
        $yesterday = TransactionReference::whereDay('created_at', $now->yesterday())
                        ->sum('amount');
        $today = TransactionReference::whereDay('created_at', $now->today())
                        ->sum('amount');

        //$json = TransactionReference::select('created_at', 'amount')->groupBy('created_at', 'amount')->get();
        //return response()->json(['data'=>$json]);
        $i = 0;
        $series = [];
        $months = [];
        foreach($weekly as $month){
            $series[$i++] = $month->amount;
            $months[$i++] = $month->month;
        }
        return view('backend.admin.tenants.financials',
        [
        'overall'=>$overall,
        'thisYear'=>$thisYear,
        'thisMonth'=>$thisMonth,
        'thisWeek'=>$thisWeek,
        'lastMonth'=>$lastMonth,
        'series'=>$series,
        'months'=>$months,
        'weekly'=>json_encode($weekly),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($slug)
    {
        $tenant = Tenant::where('slug', $slug)->first();
        $transaction = TransactionReference::where('tenant_id', $tenant->tenant_id)->first();
        $conversations = LandlordTenantConversation::where('tenant_id', $tenant->tenant_id)->get();
        if(!empty($tenant) ){
            return view('backend.admin.tenants.view',
            ['tenant'=>$tenant,
            'transaction'=>$transaction,
            'conversations'=>$conversations,
            ]);
        }else{
            return redirect()->route('404');
        }
    }

    public function memberships(){

        $now = Carbon::now();
        $expired = Membership::where('status', 0)->count();
        $expiringThisMonth = Membership::whereMonth('end_date', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->count();
        $memberships = Membership::orderBy('id', 'DESC')->get();
        return view('backend.admin.tenants.memberships',
        ['memberships'=>$memberships,
        'expired'=>$expired,
        'expiringThisMonth'=>$expiringThisMonth
        ]);
    }

    public function sendReminder(Request $request){
        $this->validate($request,[
            'subject'=>'required',
            'content'=>'required',
            'tenantId'=>'required'
        ]);
        $tenant = Tenant::where('tenant_id', $request->tenantId)->first();
        $conversation = new LandlordTenantConversation;
        $conversation->subject = $request->subject;
        $conversation->content = $request->content;
        $conversation->tenant_id = $request->tenantId;
        $conversation->type = 1; //reminder
        $conversation->slug = substr(sha1(time()), 11,40);
        $conversation->sender_id = Auth::user()->id;
        $conversation->save();
        \Mail::to($tenant)->send(new LandlordTenantEmailConversation($conversation));

        return response()->json(['message'=>'Success! Reminder sent.']);
    }
    public function sendMessage(Request $request){
        $this->validate($request,[
            'subject'=>'required',
            'content'=>'required',
            'tenantId'=>'required'
        ]);
        $tenant = Tenant::where('tenant_id', $request->tenantId)->first();
        $conversation = new LandlordTenantConversation;
        $conversation->subject = $request->subject;
        $conversation->content = $request->content;
        $conversation->tenant_id = $request->tenantId;
        $conversation->type = 0; //message
        $conversation->slug = substr(sha1(time()), 11,40);
        $conversation->sender_id = Auth::user()->id;
        $conversation->save();
        \Mail::to($tenant)->send(new LandlordTenantEmailConversation($conversation));
        return response()->json(['message'=>'Success! Message sent.']);
    }

    public function viewConversation($slug){
        $conversation = LandlordTenantConversation::where('slug', $slug)->first();
        if(!empty($conversation) ){
            return view('backend.admin.tenants.view-tenant-landlord-conversation',
            ['conversation'=>$conversation
            ]);
        }else{
            return redirect()->route('404');
        }
    }

    public function termsAndConditions(){
        $terms = TermsNCondition::first();
        return view('backend.admin.tenants.terms-n-conditions', ['terms'=>$terms]);
    }
    public function privacyPolicy(){
        $privacy = PrivacyPolicy::first();
        return view('backend.admin.tenants.privacy-policy', ['privacy'=>$privacy]);
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
