<?php

namespace App\Http\Controllers\CNX247\Backend\Accounting;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BudgetProfile;
use App\Budget;
use Auth;
use Schema;
use DB;

class BudgetController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $profiles = BudgetProfile::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.accounting.setup.budget.index',['profiles'=>$profiles]);
    }

    public function budgetProfile(Request $request){
        $this->validate($request,[
            'budget_title'=>'required',
            'budget_type'=>'required'
        ]);
        $profile = new BudgetProfile;
        switch ($request->budget_type){
            case 'Monthly':
                $record = BudgetProfile::where('tenant_id', Auth::user()->tenant_id)
                                        ->where('month_start', $request->month)
                                        ->where('month_end', $request->month)
                                        ->where('year', $request->year)
                                        ->get();
                if(count($record) > 0){
                        return response()->json(["error"=>"Ooops! There's an existing budget profile."], 400);
                    }else{
                        $profile->month_start = $request->month;
                        $profile->month_end = $request->month;
                        $profile->year = $request->year;
                        $profile->budget_type = 'Monthly';
                        $profile->budget_title = $request->budget_title;
                        $profile->tenant_id = Auth::user()->tenant_id;
                        $profile->created_by = Auth::user()->id;
                        $profile->save();
                        return response()->json(['message'=>'Success! New budget profile registered.'],200);
                    }
                break;
            case 'Quarterly':
                    $quarter = $request->quarter;
                    switch ($quarter){
                        case '1': #First quarter
                            $record = BudgetProfile::where('tenant_id', Auth::user()->tenant_id)
                                ->where('month_start', 1)
                                ->where('month_end', 3)
                                ->where('year', $request->quarter_year)
                                ->get();
                            if(count($record) > 0){
                                return response()->json(["error"=>"Ooops! There's an existing budget profile."], 400);
                            }else{
                                $profile->month_start = 1;
                                $profile->month_end = 3;
                                $profile->year = $request->quarter_year;
                                $profile->budget_type = 'Quarterly';
                                $profile->budget_title = $request->budget_title;
                                $profile->tenant_id = Auth::user()->tenant_id;
                                $profile->created_by = Auth::user()->id;
                                $profile->save();
                                return response()->json(['message'=>'Success! New budget profile registered.'],200);
                            }
                            break;
                        case '2': #Second quarter
                            $second = BudgetProfile::where('tenant_id', Auth::user()->tenant_id)
                                ->where('month_start', 4)
                                ->where('month_end', 6)
                                ->where('year', $request->quarter_year)
                                ->get();
                            if(count($second) > 0){
                                return response()->json(["error"=>"Ooops! There's an existing budget profile."], 400);
                            }else{
                                $profile->month_start = 4;
                                $profile->month_end = 6;
                                $profile->year = $request->quarter_year;
                                $profile->budget_type = 'Quarterly';
                                $profile->budget_title = $request->budget_title;
                                $profile->tenant_id = Auth::user()->tenant_id;
                                $profile->created_by = Auth::user()->id;
                                $profile->save();
                                return response()->json(['message'=>'Success! New budget profile registered.'],200);
                            }
                            break;
                        case '3': #Third quarter
                            $third = BudgetProfile::where('tenant_id', Auth::user()->tenant_id)
                                ->where('month_start', 7)
                                ->where('month_end', 9)
                                ->where('year', $request->quarter_year)
                                ->get();
                            if(count($third) > 0){
                                return response()->json(["error"=>"Ooops! There's an existing budget profile."], 400);
                            }else{
                                $profile->month_start = 7;
                                $profile->month_end = 9;
                                $profile->year = $request->quarter_year;
                                $profile->budget_type = 'Quarterly';
                                $profile->budget_title = $request->budget_title;
                                $profile->tenant_id = Auth::user()->tenant_id;
                                $profile->created_by = Auth::user()->id;
                                $profile->save();
                                return response()->json(['message'=>'Success! New budget profile registered.'],200);
                            }
                            break;
                        case '4': #Fourth quarter
                            $fourth = BudgetProfile::where('tenant_id', Auth::user()->tenant_id)
                                ->where('month_start', 10)
                                ->where('month_end', 12)
                                ->where('year', $request->quarter_year)
                                ->get();
                            if(count($fourth) > 0){
                                return response()->json(["error"=>"Ooops! There's an existing budget profile."], 400);
                            }else{
                                $profile->month_start = 10;
                                $profile->month_end = 12;
                                $profile->year = $request->quarter_year;
                                $profile->budget_type = 'Quarterly';
                                $profile->budget_title = $request->budget_title;
                                $profile->tenant_id = Auth::user()->tenant_id;
                                $profile->created_by = Auth::user()->id;
                                $profile->save();
                                return response()->json(['message'=>'Success! New budget profile registered.'],200);
                            }
                        break;
                    }
                break;
            case 'Yearly':
                $record = BudgetProfile::where('tenant_id', Auth::user()->tenant_id)
                    ->where('month_start', 0)
                    ->where('month_end', 0)
                    ->where('year', $request->yearly)
                    ->get();
                if(count($record) > 0){
                    return response()->json(["error"=>"Ooops! There's an existing budget profile."], 400);
                }else{
                    $profile->month_start = 0;
                    $profile->month_end = 0;
                    $profile->year = $request->yearly;
                    $profile->budget_type = 'Yearly';
                    $profile->budget_title = $request->budget_title;
                    $profile->tenant_id = Auth::user()->tenant_id;
                    $profile->created_by = Auth::user()->id;
                    $profile->save();
                    return response()->json(['message'=>'Success! New budget profile registered.'],200);
                }
            break;

        }
    }

    public function budgetSetup (){
        $profiles = BudgetProfile::where('tenant_id', Auth::user()->tenant_id)->get();
        $budgets = DB::table(Auth::user()->tenant_id.'_coa as c')
                            ->join('budgets as b', 'b.glcode', '=', 'c.glcode')
                            ->join('budget_profiles as bp', 'bp.id', '=', 'b.budget_profile_id')
                            ->join('users as u', 'u.id', '=', 'b.created_by')
                            ->select('bp.budget_title as bp_title', 'b.glcode as bcode', 'c.account_name as account',
                            'b.budget_title', 'b.amount', 'b.created_at','u.first_name', 'u.surname')
                            ->where('b.tenant_id',Auth::user()->tenant_id)
                            ->get();
        $accounts = DB::table(Auth::user()->tenant_id.'_coa')
                        ->whereIn('account_type', [4,5])
                        ->where('type', 'Detail')
                        ->get();
        //$budgets = Budget::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.accounting.setup.budget.budget-setup',
            [
                'profiles'=>$profiles,
                'accounts'=>$accounts,
                'budgets'=>$budgets
                ]);
    }

    public function storeBudgetSetup(Request $request){
        $this->validate($request,[
            'budget_profile'=>'required',
            'budget_title'=>'required',
            'glcode'=>'required',
            'amount'=>'required'
        ]);
        $budget = new Budget;
        $budget->budget_profile_id = $request->budget_profile;
        $budget->budget_title = $request->budget_title;
        $budget->glcode = $request->glcode;
        $budget->amount = $request->amount;
        $budget->tenant_id = Auth::user()->tenant_id;
        $budget->created_by = Auth::user()->id;
        $budget->save();
        if($budget){
            return response()->json(['message'=>'Success! New budget setup.'], 200);
        }else{
            return response()->json(['message'=>"Ooops! We couldn't setup budget. Try again."], 400);
        }
    }
}
