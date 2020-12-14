<?php

namespace App\Http\Controllers\CNX247\Backend\Accounting;

use App\Http\Controllers\Controller;
use App\JournalVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JournalEntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->get();
        return view('backend.accounting.postings.jv.create', ['accounts'=>$accounts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'issue_date'=>'required',
            'entry_no'=>'required'
        ]);
        $cr_total = 0;
        $dr_total = 0;
        for($i = 0; $i<count($request->debit_amount); $i++){
            $cr_total += $request->credit_amount[$i];
            $dr_total += $request->debit_amount[$i];
        }
        $ref_no = substr(sha1(time()), 32,40);
        if($cr_total == $dr_total){
            for($n = 0; $n<count($request->account); $n++){
                $jv = new JournalVoucher;
                $jv->glcode = $request->account[$n];
                $jv->narration = $request->narration[$n];
                $jv->name = $request->name[$n];
                $jv->dr_amount = $request->debit_amount[$n];
                $jv->cr_amount = $request->credit_amount[$n];
                $jv->ref_no = $ref_no;
                $jv->jv_date = $request->issue_date;
                $jv->entry_date = now();
                $jv->posted = 0;
                $jv->trash = 0;
                $jv->tenant_id = Auth::user()->tenant_id;
                $jv->entry_by = Auth::user()->id;
                $jv->slug = substr(sha1(time()),30,40);
                $jv->save();
            }
            session()->flash("success", "<strong>Success!</strong> New journal entry save.");
            return redirect()->route('journal-entries');
        }else{
            session()->flash("error", "<strong>Ooops!</strong> The value of DR must be same with CR. Try again.");
            return redirect()->route('journal-entries');
        }
    }

    public function journalEntries()
    {
        $entries =  DB::table(Auth::user()->tenant_id.'_coa as c')
                        ->join('journal_vouchers as j', 'j.glcode', '=', 'c.glcode')
                        ->join('users as u', 'u.id', '=', 'j.entry_by')
                        ->select('c.*', 'j.*', 'u.first_name', 'u.surname')
                        ->where('j.trash',0)
                        ->where('j.posted',0)
                        ->where('j.tenant_id', Auth::user()->tenant_id)
                        ->get();
        return view('backend.accounting.postings.jv.index', ['entries'=>$entries]);
    }

    public function view($slug)
    {
        $entry = DB::table(Auth::user()->tenant_id.'_coa as c')
                ->join('journal_vouchers as j', 'j.glcode', '=', 'c.glcode')
                ->select('c.*', 'j.*')
                ->where('j.slug', $slug)
                ->where('j.tenant_id', Auth::user()->tenant_id)
                ->first();
        if(!empty($entry)){
            return view('backend.accounting.postings.jv.view', ['entry'=>$entry]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }
    public function declineJV($slug){
        $jv = JournalVoucher::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($jv)){
            $jv->trash = 1;
            $jv->save();
            session()->flash("success", "<strong>Success!</strong> Journal Voucher trashed.");
            return redirect()->route('journal-entries');
        }
    }
    public function postJV($slug)
    {
        $jv = JournalVoucher::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if (!empty($jv)) {
            $jv->posted = 1;
            $jv->posted_date = now();
            $jv->save();

            $account = DB::table(Auth::user()->tenant_id.'_coa')->select()->where('glcode', $jv->glcode)->first();;
            # Post GL
            $bankGl = [
                'glcode' => $account->glcode,
                'posted_by' => Auth::user()->id,
                'narration' => $jv->narration ?? '',
                'dr_amount' => $jv->dr_amount > 0 ? $jv->dr_amount : 0,
                'cr_amount' => $jv->cr_amount > 0 ? $jv->cr_amount : 0,
                'ref_no' => $jv->ref_no ?? '',
                'bank' => $account->bank,
                'ob' => 0,
                'posted' => 1,
                'created_at' => $jv->jv_date,
            ];
            DB::table(Auth::user()->tenant_id . '_gl')->insert($bankGl);

            session()->flash("success", "<strong>Success!</strong> Journal Voucher posted.");
            return redirect()->route('journal-entries');
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }
}
