<?php

namespace App\Http\Controllers\CNX247\Backend\Accounting;

use App\ApplicationLog;
use App\BillMaster;
use App\Invoice;
use App\PayMaster;
use App\User;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DefaultAccount;
use App\Policy;
use App\Bank;

use Auth;
use DB;
use Schema;

class ChartOfAccountController extends Controller
{
    public $coa_fields = array(
        [
            'account_name'=>'Asset',
            'account_type'=>1,
            'bank'=>'0',
            'glcode'=>1,
            'parent_account'=>0,
            'type'=>'1'
        ],
        [
            'account_name'=>'Cash',
            'account_type'=>1,
            'bank'=>'0',
            'glcode'=>10002,
            'parent_account'=>0,
            'type'=>'1'
        ],
        [
            'account_name'=>'Liability',
            'account_type'=>2,
            'bank'=>'0',
            'glcode'=>2,
            'parent_account'=>0,
            'type'=>'1'
        ],
        [
            'account_name'=>'Equity',
            'account_type'=>3,
            'bank'=>'0',
            'glcode'=>3,
            'parent_account'=>0,
            'type'=>'1'
        ],
        [
            'account_name'=>'Revenue',
            'account_type'=>4,
            'glcode'=>4,
            'bank'=>'0',
            'parent_account'=>0,
            'type'=>'1'
        ],
        [
            'account_name'=>'Expenses',
            'account_type'=>5,
            'bank'=>'0',
            'glcode'=>5,
            'parent_account'=>0,
            'type'=>'1'
        ],
        [
            'account_name'=>'Accounts Receivable (A/R)',
            'account_type'=>1,
            'bank'=>'0',
            'glcode'=>10001,
            'parent_account'=>0,
            'type'=>'1'
        ],
        [
            'account_name'=>'Accounts Payable (A/P)',
            'account_type'=>2,
            'bank'=>'0',
            'glcode'=>20001,
            'parent_account'=>0,
            'type'=>'1'
        ],
        [
            'account_name'=>'Retained Earning',
            'account_type'=>3,
            'bank'=>'0',
            'glcode'=>301,
            'parent_account'=>0,
            'type'=>'0'
        ]
        );

    public function __construct(){
        $this->middleware('auth');
        $this->bank = new Bank();

    }

    public function dashboard(){
			$invoices = Invoice::where('trash',0)->where('tenant_id', Auth::user()->tenant_id)->whereYear('created_at', date('Y'))->orderBy('id', 'DESC')->get();
			$bills = BillMaster::where('trash',0)->where('tenant_id', Auth::user()->tenant_id)->whereYear('created_at', date('Y'))->orderBy('id', 'DESC')->get();
			$payments = PayMaster::where('trash',0)->where('tenant_id', Auth::user()->tenant_id)->whereYear('created_at', date('Y'))->orderBy('id', 'DESC')->get();
    	return view('backend.accounting.dashboard',['invoices'=>$invoices, 'bills'=>$bills, 'payments'=>$payments, 'start_date'=>now(), 'end_date'=>now()]);
		}

		public function filterDashboardResult(Request $request){
				if(empty($request->start_date)){
					session()->flash("error", "<strong>Whoops!</strong> Date range is required. Try again.");
					return back();
				}else{
					$invoices = Invoice::where('trash',0)->where('tenant_id', Auth::user()->tenant_id)->whereBetween('created_at', [$request->start_date, $request->end_date])->orderBy('id', 'DESC')->get();
					$bills = BillMaster::where('trash',0)->where('tenant_id', Auth::user()->tenant_id)->whereBetween('created_at', [$request->start_date, $request->end_date])->orderBy('id', 'DESC')->get();
					$payments = PayMaster::where('trash',0)->where('tenant_id', Auth::user()->tenant_id)->whereBetween('created_at', [$request->start_date, $request->end_date])->orderBy('id', 'DESC')->get();
					return view('backend.accounting.dashboard',['invoices'=>$invoices, 'bills'=>$bills, 'payments'=>$payments,
						'start_date'=>$request->start_date, 'end_date'=>$request->end_date
					]);
				}
		}

		public function getUsers(){
    	return User::where('tenant_id', Auth::user()->tenant_id)->where('account_status',1)->get();
		}
		public function auditTrail(){

    	return view('backend.accounting.audit-trail',['status'=>0, 'users'=>$this->getUsers()]);
		}

		public function retrieveAuditTrail(Request $request){
    	$this->validate($request,[
    		'search_parameter'=>'required'
			]);
    	#keyword phrase
					if($request->search_parameter == 1){
						if(empty($request->keyword_phrase)){
							session()->flash("error", "<strong>Whoops!</strong> Keyword phrase is required. Try again.");
							return back();
						}else{
							$logs = ApplicationLog::where('activity', 'LIKE', "%{$request->search_phrase}%")->get();
							return view('backend.accounting.audit-trail', ['status'=>1, 'logs'=>$logs, 'users'=>$this->getUsers()]);
						}
					}
			#User
				if($request->search_parameter == 2){
					if(empty($request->user)){
						session()->flash("error", "<strong>Whoops!</strong> User is required. Try again.");
						return back();
					}else{
						$logs = ApplicationLog::where('user_id', $request->user)->get();
						return view('backend.accounting.audit-trail', ['status'=>1, 'logs'=>$logs, 'users'=>$this->getUsers()]);
					}
				}
			#Date range
				if($request->search_parameter == 3){
					if(empty($request->start_date)){
						session()->flash("error", "<strong>Whoops!</strong> Date range is required. Try again.");
						return back();
					}else{
						$logs = ApplicationLog::whereBetween('created_at', [$request->start_date, $request->end_date])->get();
						return view('backend.accounting.audit-trail', ['status'=>1, 'logs'=>$logs, 'users'=>$this->getUsers()]);
					}
				}
		}

    public function index(){
        $exist = null;
        if(!Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
            $exist = 'no';
            return view('backend.accounting.setup.coa.index', ['exist'=>$exist]);
        }else{
            $exist = 'yes';
            $charts = DB::table(Auth::user()->tenant_id.'_coa')->get();
            return view('backend.accounting.setup.coa.index', ['exist'=>$exist, 'charts'=>$charts]);
        }
    }

    public function createCOA(){
        if(!Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa') || !Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_gl')){

            //Create table
            Schema::connection('mysql')->create(Auth::user()->tenant_id.'_coa', function($table)
            {
                $table->increments('id');
                $table->string('account_name');
                $table->tinyInteger('account_type');
                $table->integer('bank')->default(0);
                $table->unsignedBigInteger('glcode');
                $table->integer('parent_account')->nullable();
                $table->tinyInteger('type')->default(1)->comment('1=Detail, 0=General');
                $table->timestamps();
            });
            #Insert default records into table

                $default = DB::table(Auth::user()->tenant_id.'_coa')->insert($this->coa_fields);
            Schema::connection('mysql')->create(Auth::user()->tenant_id.'_gl', function($table)
            {
                $table->increments('id');
                $table->unsignedBigInteger('glcode');
                $table->string('posted_by');
                $table->string('narration')->nullable();
                $table->double('dr_amount')->default(0);
                $table->double('cr_amount')->default(0);
                $table->string('ref_no')->nullable();
                $table->integer('bank')->nullable();
                $table->double('ob')->default(0);
                $table->dateTime('transaction_date')->default(0);
                $table->tinyInteger('posted')->default(0)->nullable();
                $table->timestamps();
            });
        }
        session()->flash("success", "<strong>Success!</strong> Chart of Accounts created.");
        return back();
    }
    public function getParentAccount(Request $request){
        $this->validate($request,[
            'account_type'=>'required'
        ]);
        if($request->type == '1'){
            $account = DB::table(Auth::user()->tenant_id.'_coa')->select('account_name', 'id', 'type', 'glcode')
                ->where('type',0)
                ->where('account_type',$request->account_type)
                ->get();
            return response()->json(['parents'=>$account],200);
        }else{
            $account = DB::table(Auth::user()->tenant_id.'_coa')->select('account_name', 'id', 'type', 'glcode')
                ->where('account_type',$request->account_type)
                ->get();
            return response()->json(['parents'=>$account],200);
        }
    }
    public function saveAccount(Request $request){
        $this->validate($request,[
            "glcode"=>"required|unique:".Auth::user()->tenant_id."_coa,glcode",
            //"account_name"=>"required|unique:".Auth::user()->tenant_id."_coa, account_name",
            "account_type"=>"required",
            "type"=>"required",
            "bank"=>"required",
            "parent_account"=>"required"
            ]);
        $coa = DB::table(Auth::user()->tenant_id.'_coa')->insert($request->all());
        return response()->json(['message'=>'Success! New account registered.'], 200);
    }

    public function vat(){
        $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 1)->select()->get();
        $policy = DB::table(Auth::user()->tenant_id.'_coa as c')
										->join('policies as p', 'p.glcode', '=', 'c.glcode')
										->first();
        /*return dd($policy);
					Policy::where('tenant_id', Auth::user()->tenant_id)->first();*/
        return view('backend.accounting.setup.vat.index',['accounts'=>$accounts,'policy'=>$policy]);
    }
    public function postVat(Request $request){
        $request->validate([
            'vat'=>'required',
            'account'=>'required'
        ]);
        $policy = Policy::where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($policy)){
            $policy->vat = $request->vat;
            $policy->glcode = $request->account;
            $policy->tenant_id = Auth::user()->tenant_id;
            $policy->save();
            return response()->json(['message'=>'Success! VAT and account set.'], 200);
        }else{
            $new = new Policy;
            $new->vat = $request->vat;
            $new->glcode = $request->account;
            $new->tenant_id = Auth::user()->tenant_id;
            $new->save();
            return response()->json(['message'=>'Success! VAT and account set.'], 200);
        }
    }

    public function openingBalance(){
        $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 1)->select()->get();
        $opening_balances = DB::table(Auth::user()->tenant_id.'_gl as g')
                            ->join(Auth::user()->tenant_id.'_coa as c', 'g.glcode', '=', 'c.glcode')
                            ->select('g.glcode as gcode', 'c.glcode as ccode', 'c.account_name as account',
                            'g.narration', 'g.ref_no', 'g.bank', 'g.dr_amount', 'g.cr_amount',
                            'g.transaction_date', 'g.posted_by')
                            ->where('g.ob',1)
                            ->get();
        return view('backend.accounting.setup.ob.index',['accounts'=>$accounts, 'opening_balances'=>$opening_balances]);
    }

    public function postOpeningBalance(Request $request){
        try{
            $request->validate([
                'debit'=>'required',
                'credit'=>'required',
                'account_name'=>'required',
                'date'=>'required|date',
                'transaction_type'=>'required'
            ]);

        }catch(ValidationException $ex){
            return response()->json([
                'status' => 'error',
                'msg'    => 'Submission failed. Try again.',
                'errors' => $ex->errors(),
            ], 422);
        }
        $tenant_id = Auth::user()->tenant_id;
        $account = DB::table($tenant_id.'_coa')->select()->where('glcode', $request->account_name)->first();
        $posted_by = Auth::user()->first_name.' '.Auth::user()->surname;
        if($request->transaction_type == 1){ //debit
            $dr_trans = [
                'glcode'=>$request->account_name,
                'posted_by'=>$posted_by,
                'narration'=>'Opening Balance',
                'dr_amount'=>$request->debit,
                'cr_amount'=>0,
                'ref_no'=>strtoupper(substr(sha1(time()),34,60)),
                'bank'=>$account->bank,
                'ob'=>1,
                'created_at'=>now(),
                'transaction_date'=>$request->date,
                'updated_at'=>now()
            ];
            DB::table($tenant_id.'_gl')->insert($dr_trans);
        }else{
            $cr_trans = [
                'glcode'=>$request->account_name,
                'posted_by'=>$posted_by,
                'narration'=>'Opening Balance',
                'cr_amount'=>$request->credit,
                'dr_amount'=>0,
                'ref_no'=>strtoupper(substr(sha1(time()),34,60)),
                'bank'=>$account->bank,
                'ob'=>1,
                'created_at'=>now(),
                'transaction_date'=>$request->date,
                'updated_at'=>now()
            ];
            DB::table($tenant_id.'_gl')->insert($cr_trans);
        }
        return response()->json(['message'=>'Success! Opening balance saved.'], 200);
    }

    public function ledgerDefaultsVariables(){
        $accounts = DB::table(Auth::user()->tenant_id.'_coa')->select()->get();
        $defaults = DB::table(Auth::user()->tenant_id.'_coa as c')
                            ->join('default_accounts as d', 'd.glcode', '=', 'c.glcode')
                            ->select('d.glcode as dcode', 'c.account_name', 'd.handle')
                            ->get();
        return view('backend.accounting.setup.ledger.defaults-variables', ['accounts'=>$accounts,'defaults'=>$defaults]);
    }

    public function updateDefaultsVariables(Request $request){
        $this->validate($request,[
            'account.*'=>'required',
            'handle'=>'required'
        ]);

         for($i = 0; $i<count($request->handle); $i++){
            $update = DefaultAccount::where('tenant_id', Auth::user()->tenant_id)->where('handle', $request->handle[$i])->first();
            $update->handle = $request->handle[$i];
            $update->glcode = $request->account[$i];
            $update->set_by = Auth::user()->id;
            $update->save();
        }
        session()->flash("success", "<strong>Success!</strong> Changes saved.");
        return back();
    }

	public function addNewBank(Request $request){
		$this->validate($request, [
			'bank_name'=>'required|unique:banks,bank_name',
			'bank_gl_code' =>'required|unique:banks,bank_gl_code',
			'bank_branch'=>'required',
			'bank_account_number' => 'required',

		]);
			$this->bank->setNewBank($request);
			session()->flash("success", "<strong>Success! </strong> New bank registered.");
				return back();
	}
    public function bank()
    {
        $tenant_id = Auth::user()->tenant_id;
        $bank_details =   DB::table($tenant_id."_coa")->select()->where('bank', '=', 1)->get();
        $data['banks'] = DB::table(Auth::user()->tenant_id.'_coa as c')
														->join('banks as b', 'b.bank_gl_code', '=', 'c.glcode')
														->select()
														->get();
					//DB::table('banks')->select()->where('tenant_id', '=', $tenant_id)->get();

        $data['bank_details'] = $bank_details;
        return view('backend.accounting.bank.index', $data);
    }

    public function updateBank(Request $request){
    	$this->validate($request,[
    		'bank'=>'required',
				'bank_name'=>'required',
				'bank_glcode'=>'required',
				'account_no'=>'required'
			]);
    	$this->bank->updateBank($request);
    	session()->flash("success", "<strong>Success!</strong> Changes saved.");
    	return back();
		}


    public function edit(Request $request)
    {
        if($request->edit_mode == 1){
            $bank = Bank::find($request->bank_id);

            //print_r($bank);

            $bank->bank_gl_code = $request->bank_gl_code;
            $bank->save();

            //session()->flash("success", "<strong>Success! </strong> Changes saved.");
            return Redirect::back()->withErrors(['success', '<strong>Success! </strong> Changes saved.']);
          //return response()->json(['message'=>'Success! New budget profile registered.'],200);
//            $this->bank_code = '';
//            $this->bank_name = '';
//            $this->getContent();
//            $this->edit_mode = 0;
        }else{

            echo "i got here";
//            $bank = new Bank;
//            $bank->bank_gl_code = $this->bank_gl_code;
//            $bank->bank_account_number = $this->bank_account_number;
//            $bank->bank_name = $this->bank_name;
//            $bank->bank_branch = $this->bank_branch;
//            $bank->tenant_id = Auth::user()->tenant_id;
//            $bank->save();
//            session()->flash("success", "<strong>Success! </strong> New bank registered.");
//            $this->bank_code = '';
//            $this->bank_name = '';
//            $this->getContent();
        }
    }

}
