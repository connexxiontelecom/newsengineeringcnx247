<?php

namespace App\Http\Controllers\CNX247\Backend\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DefaultAccount;
use Carbon\Carbon;
use Auth;
use DB;
use Schema;

class ReportController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function trialBalanceView(){
        return view('backend.accounting.reports.accounting-period');
    }
    public function trialBalance(Request $request){
        $messages = [
            'to'=>'Choose :attribute your account start period',
            'from'=>'Choose :attribute account closing period'
        ];
        $this->validate($request,[
            'from'=>'required|date',
            'to'=>'required|date|after_or_equal:from'
        ], $messages);
        $current = Carbon::now();
        $inception = DB::table(Auth::user()->tenant_id.'_gl')->orderBy('id', 'ASC')->first();
        if(!empty($inception)){
            $bfDr = DB::table(Auth::user()->tenant_id.'_gl')->whereBetween('created_at', [$inception->created_at, $current->parse($request->from)->subDays(1)])->sum('dr_amount');
            $bfCr = DB::table(Auth::user()->tenant_id.'_gl')->whereBetween('created_at', [$inception->created_at, $current->parse($request->from)->subDays(1)])->sum('cr_amount');
            $reports = DB::table(Auth::user()->tenant_id.'_gl as g')
                ->join(Auth::user()->tenant_id.'_coa as c', 'c.glcode', '=', 'g.glcode')
                ->select(DB::raw('sum(g.dr_amount) AS sumDebit'),DB::raw('sum(g.cr_amount) AS sumCredit'),
                    'c.account_name', 'g.glcode', 'c.glcode', 'c.account_type', 'c.type')
                //->where('c.account_type', 1)
                ->where('c.type', 'Detail')
                ->whereBetween('g.created_at', [$request->from, $request->to])
                ->orderBy('c.account_type', 'ASC')
                ->groupBy('c.account_name')
                ->get();
            return view('backend.accounting.reports.trial-balance', [
                'reports'=>$reports,
                'bfDr'=>$bfDr,
                'bfCr'=>$bfCr,
                'from'=>$request->from,
                'to'=>$request->to
            ]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }

    public function balanceSheetView(){
        return view('backend.accounting.reports.balance-sheet-setup');
    }
    public function balanceSheet(Request $request){
        $this->validate($request,[
            'date'=>'required|date'
        ]);
        $current = Carbon::now();
        $inception = DB::table(Auth::user()->tenant_id.'_gl')->orderBy('id', 'ASC')->first();
        if(!empty($inception)){
            $bfDr = DB::table(Auth::user()->tenant_id.'_gl')->whereBetween('created_at', [$inception->created_at,$request->date])->sum('dr_amount');
            $bfCr = DB::table(Auth::user()->tenant_id.'_gl')->whereBetween('created_at',[$inception->created_at,$request->date])->sum('cr_amount');
            $reports = DB::table(Auth::user()->tenant_id.'_gl as g')
                ->join(Auth::user()->tenant_id.'_coa as c', 'c.glcode', '=', 'g.glcode')
                ->select(DB::raw('sum(g.dr_amount) AS sumDebit'),DB::raw('sum(g.cr_amount) AS sumCredit'),
                    'c.account_name', 'g.glcode', 'c.glcode', 'c.account_type', 'c.type')
                //->where('c.account_type', 1)
                ->where('c.type', 'Detail')
                ->whereBetween('g.created_at', [$inception->created_at,$request->date])
                ->orderBy('c.account_type', 'ASC')
                ->groupBy('c.account_name')
                ->get();
            $revenue = DB::table(Auth::user()->tenant_id.'_gl as g')
                            ->join(Auth::user()->tenant_id.'_coa as c', 'c.glcode', '=', 'g.glcode')
                            ->where('c.type', 'Detail')
                            ->whereIn('c.account_type', [4])
                            ->whereBetween('g.created_at', [$inception->created_at,$request->date])
                            ->get();
            $expense = DB::table(Auth::user()->tenant_id.'_gl as g')
                            ->join(Auth::user()->tenant_id.'_coa as c', 'c.glcode', '=', 'g.glcode')
                            ->where('c.type', 'Detail')
                            ->whereIn('c.account_type', [5])
                            ->whereBetween('g.created_at', [$inception->created_at,$request->date])
                            ->get();
            return view('backend.accounting.reports.balance-sheet', [
                'reports'=>$reports,
                'bfDr'=>$bfDr,
                'bfCr'=>$bfCr,
                'date'=>$request->date,
                'revenue'=>$revenue,
                'expense'=>$expense
            ]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }
    public function profitOrLossView(){
        return view('backend.accounting.reports.profit-o-loss-setup');
    }

    public function profitOrLoss(Request $request){
        $messages = [
            'to'=>'Choose :attribute your account start period',
            'from'=>'Choose :attribute account closing period'
        ];
        $this->validate($request,[
            'from'=>'required|date',
            'to'=>'required|date|after_or_equal:from'
        ], $messages);
        $current = Carbon::now();
        $inception = DB::table(Auth::user()->tenant_id.'_gl')->orderBy('id', 'ASC')->first();
        if(!empty($inception)){
            $bfDr = DB::table(Auth::user()->tenant_id.'_gl')->whereBetween('created_at', [$inception->created_at, $current->parse($request->from)->subDays(1)])->sum('dr_amount');
            $bfCr = DB::table(Auth::user()->tenant_id.'_gl')->whereBetween('created_at', [$inception->created_at, $current->parse($request->from)->subDays(1)])->sum('cr_amount');
            $reports = DB::table(Auth::user()->tenant_id.'_gl as g')
                ->join(Auth::user()->tenant_id.'_coa as c', 'c.glcode', '=', 'g.glcode')
                ->select(DB::raw('sum(g.dr_amount) AS sumDebit'),DB::raw('sum(g.cr_amount) AS sumCredit'),
                    'c.account_name', 'g.glcode', 'c.glcode', 'c.account_type', 'c.type')
                //->where('c.account_type', 1)
                ->where('c.type', 'Detail')
                ->whereBetween('g.created_at', [$request->from, $request->to])
                ->orderBy('c.account_type', 'ASC')
                ->groupBy('c.account_name')
                ->get();
            $revenue = DB::table(Auth::user()->tenant_id.'_gl as g')
                            ->join(Auth::user()->tenant_id.'_coa as c', 'c.glcode', '=', 'g.glcode')
                            ->where('c.type', 'Detail')
                            ->whereIn('c.account_type', [4])
                            ->whereBetween('g.created_at', [$request->from, $request->to])
                            ->get();
            $expense = DB::table(Auth::user()->tenant_id.'_gl as g')
                            ->join(Auth::user()->tenant_id.'_coa as c', 'c.glcode', '=', 'g.glcode')
                            ->where('c.type', 'Detail')
                            ->whereIn('c.account_type', [5])
                            ->whereBetween('g.created_at', [$request->from, $request->to])
                            ->get();
            return view('backend.accounting.reports.profit-o-loss',[
                'reports'=>$reports,
                'bfDr'=>$bfDr,
                'bfCr'=>$bfCr,
                'from'=>$request->from,
                'to'=>$request->to,
                'revenue'=>$revenue,
                'expense'=>$expense
            ]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }
}
