<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\NewPostNotification;
use App\Post;
use App\ResponsiblePerson;
use App\ProjectBudget;
use App\ProjectDetail;
use App\Participant;
use App\Observer;
use App\Priority;
use App\Milestone;
use App\Currency;
use App\BudgetFinance;
use App\Status;
use App\Link;
use App\User;
use App\Budget;
use App\Policy;
use App\Client;
use App\Invoice;
use App\InvoiceItem;
use App\Supplier;
use App\BillMaster;
use App\BillDetail;
use Auth;
use Schema;
use DB;
use DateTime;
class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * project board
    */
    public function projectBoard(){
        return view('backend.project.project-board');
    }
    /*
    * New task
    */
    public function newProject(){
        $users = User::select('first_name', 'surname', 'id')
                            ->where('account_status',1)->where('verified', 1)
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->orderBy('first_name', 'ASC')->get();
        $budgets = Budget::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.project.new-project',['users'=>$users, 'budgets'=>$budgets]);
    }
    /*
    * store new task
    */
    public function storeProject(Request $request){

        $this->validate($request,[
            'project_name'=>'required',
            'responsible_persons'=>'required',
            'project_description'=>'required',
            'due_date'=>'required|date|after_or_equal:start_date',
            'start_date'=>'required|date',
            'project_sponsor'=>'required'
        ]);

        $url = substr(sha1(time()), 10, 10);
        $project = new Post;
        $project->post_title = $request->project_name;
        $project->user_id = Auth::user()->id;
        $project->post_content = $request->project_description;
        $project->post_color = $request->color;
        $project->project_manager_id = $request->project_manager;
        $project->post_type = 'project';
        $project->post_url = $url;
        $project->budget = $request->budget ?? '';
				$project->sponsor = $request->project_sponsor;


       /*  $project->start_date = $request->start_date ?? '';
				$project->end_date = $request->due_date; */

				$startDateInstance = new DateTime($request->start_date);
				$project->start_date = $startDateInstance->format('Y-m-d H:i:s');

					$dueDateInstance = new DateTime($request->due_date);
				$project->end_date = $dueDateInstance->format('Y-m-d H:i:s');


        $project->post_priority = $request->priority;
        $project->tenant_id = Auth::user()->tenant_id;
        //$task->attachment = $filename;
        $project->save();
        $project_id = $project->id;
        //responsible persons
        if(!empty($request->responsible_persons)){
            foreach($request->responsible_persons as $responsible){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $responsible;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
                //notify this user
                $user = User::find($responsible);
                $user->notify(new NewPostNotification($project));
            }
        }
        //participants
        if(!empty($request->participants)){
            foreach($request->participants as $participant){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $participant;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        //observers
        if(!empty($request->observers)){
            foreach($request->observers as $observer){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $observer;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        session()->flash("success", "<strong>Success! </strong> Project created.");
        return redirect()->route('project-board');
    }


    /*
    * New task
    */
    public function viewProject(){

        return view('backend.project.view-project');
    }
    public function projectBudget($url){

        $project = Post::where('post_url', $url)
                        ->where('tenant_id',Auth::user()->tenant_id)->first();
        if(!empty($project)){
            $budgets = ProjectBudget::where('project_id', $project->id)->get();
            return view('backend.project.budget',['project'=>$project, 'budgets'=>$budgets]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Record not found.");
            return back();
        }
    }

    public function storeProjectBudget(Request $request){
        $this->validate($request,[
            'budget_head'=>'required',
            'amount'=>'required'
        ]);
        $budget = new ProjectBudget;
        $budget->budget_title = $request->budget_head;
        $budget->budget_amount = $request->amount;
        $budget->comment = $request->comment;
        $budget->created_by = Auth::user()->id;
        $budget->tenant_id = Auth::user()->tenant_id;
        $budget->project_id = $request->projectId;
        $budget->save();
        session()->flash("success", "<strong>Success!</strong> Budget saved.");
        return back();

    }
    /*
    * Project calendar
    */
    public function projectCalendar(){
        return view('backend.project.project-calendar');
    }

    /*
    * Project calendar
    */
    public function getProjectCalendarData(){
        $project = Post::select('post_title as title', 'start_date as start', 'end_date as end', 'post_color as color')
                    ->where('post_type', 'project')
                    ->where('tenant_id', Auth::user()->tenant_id)->get();
        return response($project);
    }
    /*
    * Project gantt chart [view]
    */
    public function projectGanttChart(){
        return view('backend.project.project-gantt-chart');
    }
    /*
    * Project Gantt Chart
    */
    public function getProjectGanttChartData(){
        $project = Post::select('post_title as text', 'start_date', 'end_date', 'post_color as color')
                    ->where('post_type', 'project')
                    ->where('tenant_id', Auth::user()->tenant_id)
                    ->orderBy('id', 'DESC')
                    ->get();
        $links = Link::all();
        return response()->json([
            'data'=>$project,
            'links'=>$links
             ]);
    }

    /*
    * Project analytics
    */
    public function projectAnalytics(){
        return view('backend.project.project-analytics');
    }

     /*
    * edit project
    */
    public function editProject($url){
        $users = User::select('first_name', 'surname', 'id')
                    ->where('account_status',1)->where('verified', 1)
                    ->where('tenant_id',Auth::user()->tenant_id)
                    ->orderBy('first_name', 'ASC')->get();
        $priorities = Priority::all();
        $statuses = Status::all();
        $project = Post::where('post_url', $url)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($project) ){
            return view('backend.project.edit-project',[
                'users'=>$users,
                'priorities'=>$priorities,
                'statuses'=>$statuses,
                'project'=>$project
            ]);

        }else{
            return redirect()->route('404');
        }
    }

        /*
    * update project
    */
    public function updateProject(Request $request){
        //return dd($request->all());
        $this->validate($request,[
            'project_name'=>'required',
            'project_description'=>'required',
            'due_date'=>'required|date',
            'start_date'=>'required|after_or_equal:due_date',
            'project_sponsor'=>'required'
        ]);
        $project = Post::where('post_url', $request->url)->where('tenant_id', Auth::user()->tenant_id)->first();
        $project->post_title = $request->project_name;
        $project->user_id = Auth::user()->id;
        $project->post_content = $request->project_description;
        $project->post_color = $request->color;
        $project->project_manager_id = $request->project_manager;
        $project->post_type = 'project';
        $project->post_url = $request->url;
        $project->sponsor = $request->project_sponsor;
        $project->start_date = $request->start_date ?? '';
        $project->end_date = $request->due_date;
        $project->post_priority = $request->priority;
        $project->tenant_id = Auth::user()->tenant_id;
        $project->save();
        session()->flash("success", "<strong>Success!</strong> Project changes saved.");
        return redirect()->route('project-board');
    }

    public function createProjectMilestone(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'due_date'=>'required|date'
        ]);
        $milestone = new Milestone;
        $milestone->title = $request->title;
        $milestone->due_date = $request->due_date;
        $milestone->description = $request->description;
        $milestone->tenant_id = Auth::user()->tenant_id;
        $milestone->user_id = Auth::user()->id;
        $milestone->post_id = $request->post_id;
        $milestone->save();
        return response()->json(['message'=>'Success! Project milestone created.'], 200);
    }

    public function deleteProject(Request $request){
        $this->validate($request,[
            'projectId'=>'required'
        ]);
        $task = Post::where('tenant_id', Auth::user()->tenant_id)
                    ->where('id', $request->projectId)->first();
        if(!empty($task) ){
            $task->delete();
            $responsible = ResponsiblePerson::where('post_id', $request->projectId)
                                            ->where('tenant_id', Auth::user()->tenant_id)
                                            ->get();
            if(!empty($responsible) ){
                foreach($responsible as $person){
                    $person->delete();
                }
            }
            #Observers
            $observers = Observer::where('post_id', $request->projectId)
                                            ->where('tenant_id', Auth::user()->tenant_id)
                                            ->get();
            if(!empty($observers) ){
                foreach($observers as $observer){
                    $observer->delete();
                }
            }
            #Participants
            $participants = Participant::where('post_id', $request->projectId)
                                            ->where('tenant_id', Auth::user()->tenant_id)
                                            ->get();
            if(!empty($participants) ){
                foreach($participants as $participant){
                    $participant->delete();
                }
            }
        }
        session()->flash("success", "<strong>Success!</strong> Task deleted.");
        return redirect()->back();
    }



    public function addResponsiblePerson(Request $request)
    {

        $this->validate($request, [
            'taskId' => 'required',
            'responsible_persons' => 'required',
        ]);

        $task = Post::where('tenant_id', Auth::user()->tenant_id)
            ->where('id', $request->taskId)->first();

        if (!empty($request->responsible_persons)) {
            foreach ($request->responsible_persons as $participant) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;

                $exists = ResponsiblePerson::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $request->taskId)->first();

                if (empty($exists) || is_null($exists)) {

                    $part->post_id = $request->taskId;
                    $part->post_type = 'project';
                    $part->user_id = $participant;
                    $part->tenant_id = Auth::user()->tenant_id;
                    $part->save();
                    $user = User::find($participant);
                    $user->notify(new NewPostNotification($task));

                }
            }
        }
        return redirect()->route('view-project', ["url" => $request->url]);
    }



    public function addParticipant(Request $request)
    {

        $this->validate($request, [
            'taskId' => 'required',
            'participants' => 'required',
        ]);

        $task = Post::where('tenant_id', Auth::user()->tenant_id)
            ->where('id', $request->taskId)->first();

        if (!empty($request->participants)) {
            foreach ($request->participants as $participant) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant();

                $exists = Participant::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $request->taskId)->first();

                if (empty($exists) || is_null($exists)) {

                    $part->post_id = $request->taskId;
                    $part->post_type = 'project';
                    $part->user_id = $participant;
                    $part->tenant_id = Auth::user()->tenant_id;
                    $part->save();
                    $user = User::find($participant);
                    $user->notify(new NewPostNotification($task));

                }
            }
        }
        return redirect()->route('view-project', ["url" => $request->url]);
    }


    public function addObserver(Request $request)
    {

        $this->validate($request, [
            'taskId' => 'required',
            'observers' => 'required',
        ]);

        $task = Post::where('tenant_id', Auth::user()->tenant_id)
            ->where('id', $request->taskId)->first();

        if (!empty($request->observers)) {
            foreach ($request->observers as $participant) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer();

                $exists = Observer::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $request->taskId)->first();

                if (empty($exists) || is_null($exists)) {

                    $part->post_id = $request->taskId;
                    $part->post_type = 'project';
                    $part->user_id = $participant;
                    $part->tenant_id = Auth::user()->tenant_id;
                    $part->save();
                    $user = User::find($participant);
                    $user->notify(new NewPostNotification($task));

                }
            }
        }
        return redirect()->route('view-project', ["url" => $request->url]);
    }

    public function projectInvoice($slug){
        $status = null;
				$project = Post::where('post_url', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
				$policy = Policy::where('tenant_id', Auth::user()->tenant_id)->first();
				$currencies = Currency::all();
        $invoice_no = null;
        if(!empty($project)){
            $clients = Client::where('tenant_id', Auth::user()->tenant_id)->get();
            $budgets = ProjectBudget::where('project_id', $project->id)->where('tenant_id', Auth::user()->tenant_id)->get();
            $invoice = Invoice::where('tenant_id', Auth::user()->tenant_id)
            ->where('project_id', $project->id)
            ->orderBy('project_id', 'DESC')->first();
                if(!empty($invoice)){
                    $invoice_no = $invoice->invoice_no + 1;
                }else{
                    $invoice_no = 1000;
                }
            if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
                $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->select()->get();
                $status = 1; //subscribed for accounting package
                return view('backend.project.invoice', [
                    'project'=>$project,
                    'accounts'=>$accounts,
                    'status'=>$status,
                    'clients'=>$clients,
                    'invoice_no'=>$invoice_no,
										'budgets'=>$budgets,
										'policy'=>$policy,
										'currencies'=>$currencies
                    ]);
            }else{
                $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->select()->get();
                return view('backend.project.invoice', [
                    'project'=>$project,
                    'status'=>0,
                    'clients'=>$clients,
                    'invoice_no'=>$invoice_no,
                    'budgets'=>$budgets,
										'policy'=>$policy,
										'currencies'=>$currencies
                    ]);
            }
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }

    public function storeProjectInvoice(Request $request){
			//return dd($request->all());
        if(count($request->accounts) > 0){
            $totalAmount = 0;
            $arrayCount = 0;
						for($i = 0;  $i<count($request->accounts); $i++){
							if(str_replace(',','',$request->amount[$i]) != null){
								$totalAmount += str_replace( ',', '', $request->amount[$i]) ;
									$arrayCount++;
							}
					}
					$ref_no = strtoupper(substr(sha1(time()), 32,40));
					$policy = Policy::where('tenant_id', Auth::user()->tenant_id)->first();
            $master = new Invoice;
            $master->invoice_no = $request->invoice_no;
            $master->ref_no = $ref_no;
            $master->client_id = $request->client;
            $master->project_id = $request->ref_no;
            $master->issue_date = $request->date;
						$master->due_date = $request->due_date;
						$master->total = $request->currency != Auth::user()->tenant->currency->id ? ($totalAmount * $request->exchange_rate + ($totalAmount*$policy->vat)/100 * $request->exchange_rate ) : ($totalAmount + ($totalAmount*$policy->vat)/100 ) ;
						$master->sub_total = $request->currency != Auth::user()->tenant->currency->id ? ($totalAmount * $request->exchange_rate) -  (($totalAmount*$policy->vat)/100 * $request->exchange_rate ): $totalAmount - ($totalAmount*$policy->vat)/100 ;
						$master->tax_rate = $policy->vat ?? 0;
						$master->tax_value = $request->currency != Auth::user()->tenant->currency->id ?  ($policy->vat*$totalAmount)/100 * $request->exchange_rate : ($policy->vat*$totalAmount)/100;
						$master->currency_id = $request->currency;
						$master->exchange_rate = $request->exchange_rate ?? 1;
            $master->issued_by = Auth::user()->id;
            $master->tenant_id = Auth::user()->tenant_id;
            $master->slug = substr(sha1(time()),32,40);
            $master->save();
						$invoiceId = $master->id;
						#Payment
						$payment = array_filter($request->amount);
						$reIndexedPayment = array_values($payment);
						#accounts
						$accountArray = array_filter($request->accounts);
						$reIndexedAccounts = array_values($accountArray);
                #project budget table
                /* $budget = ProjectBudget::where('project_id', $request->ref_no)
                                        ->where('tenant_id', Auth::user()->tenant_id)
                                        ->where('id', $request->budget)
																				->first();
								if(!empty($budget)){
									$budget->actual_amount += $totalAmount;
									$budget->save();
								}*/
                #update budgetFinance
                $budgetFinance = new BudgetFinance;
                $budgetFinance->project_id = $request->ref_no;
                $budgetFinance->invoice_id = $invoiceId;
                $budgetFinance->budget_id = $request->budget;
                $budgetFinance->tenant_id = Auth::user()->tenant_id;
                $budgetFinance->save();
                $project = Post::where('id',$request->ref_no)->where('tenant_id', Auth::user()->tenant_id)->first();
                for($i = 0; $i<count($request->accounts); $i++){
                    $invoice = new InvoiceItem;
                    $invoice->tenant_id = Auth::user()->tenant_id;
                    $invoice->description = $request->description[$i] ?? 'No description';
                    $invoice->glcode = $request->accounts[$i];
                    $invoice->total = (int)str_replace(',','',$request->amount[$i]) * $request->exchange_rate;
                    $invoice->invoice_id = $invoiceId;
                    $invoice->client_id = $request->client;
                    $invoice->save();
								}
								$client = Client::where('id',$request->client)->where('tenant_id', Auth::user()->tenant_id)->first();
								if(empty($client->glcode)){
										$client->glcode = $request->client_account;
										$client->save();
								}

            #Check for accounting module
            if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
                $policy = Policy::where('tenant_id', Auth::user()->tenant_id)->first();
                $detail = InvoiceItem::where('invoice_id', $master->id)->where('tenant_id', Auth::user()->tenant_id)->get();
                # Post GL
                $invoicePost = [
                    'glcode' => $client->glcode,
                    'posted_by' => Auth::user()->id,
                    'narration' => 'Invoice generation for ' . $client->company_name ?? '',
                    'dr_amount' => $request->currency != Auth::user()->tenant->currency->id ?  ($totalAmount*$request->exchange_rate) + (($totalAmount*$policy->vat)/100 * $request->exchange_rate) : ($totalAmount + ($totalAmount*$policy->vat)/100),
                    'cr_amount' => 0,
                    'ref_no' => $ref_no,
                    'bank' => 0,
                    'ob' => 0,
                    'transaction_date' => $master->created_at,
                    'created_at' => $master->created_at
                ];
                DB::table(Auth::user()->tenant_id . '_gl')->insert($invoicePost);
                $VATPost = [
                    'glcode' => $policy->glcode,
                    'posted_by' => Auth::user()->id,
                    'narration' => 'VAT on invoice no. '.$master->invoice_no.' for '.$client->company_name,
                    'dr_amount' => 0,
                    'cr_amount' => $request->currency != Auth::user()->tenant->currency->id ? ($totalAmount*$policy->vat)/100 * $request->exchange_rate : ($totalAmount*$policy->vat)/100,
                    'ref_no' => $ref_no,
                    'bank' => 0,
                    'ob' => 0,
                    'transaction_date' => $master->created_at,
                    'created_at' => $master->created_at
                ];
                DB::table(Auth::user()->tenant_id . '_gl')->insert($VATPost);
                foreach($detail as $d){
                    $receiptPost = [
                        'glcode' => $d->glcode,
                        'posted_by' => Auth::user()->id,
                        'narration' => 'Invoice generation for ' . $d->description,
                        'dr_amount' => 0,
                        'cr_amount' => $d->total,
                        'ref_no' => $ref_no,
                        'bank' => 0,
                        'ob' => 0,
                        'transaction_date' => $invoice->created_at,
                        'created_at' => $invoice->created_at
                    ];
                    DB::table(Auth::user()->tenant_id . '_gl')->insert($receiptPost);
                }

        }

            session()->flash("success", "<strong>Success! </strong> Invoice submitted.");
            return redirect()->route('view-project', $project->post_url);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Something went wrong. Try again.");
            return redirect()->route('view-project', $project->post_url);
        }
    }

    public function projectReceipt($slug){
        $status = null;
        $project = Post::where('post_url', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        $invoice = Invoice::where('project_id', $project->id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $receipt_no = null;
        $receipt = Receipt::where('tenant_id', Auth::user()->tenant_id)
                            ->orderBy('id', 'DESC')
                            ->first();
        $banks = DB::table(Auth::user()->tenant_id.'_coa as c')
                        ->join('banks as b', 'b.bank_gl_code', '=', 'c.glcode')
                        ->get();
        $client = Client::where('tenant_id', Auth::user()->tenant_id)->where('id', $invoice->client_id)->first();
        $invoices = Invoice::where('tenant_id', Auth::user()->tenant_id)
                            ->where('status','!=', 1)
                            ->where('project_id', $project->id)->get();
        if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
            $status = 1; //subscribed for accounting package
            if(!empty($receipt)){
                $receipt_no = $receipt->receipt_no + 1;
            }else{
                $receipt_no = 1000;
            }
            session()->flash("success", "<strong>Success! </strong> Invoice submitted.");
            return redirect()->route('project-board');
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Something went wrong. Try again.");
            return redirect()->route('view-project', $project->post_url);
        }
    }

    public function projectBill($slug){
        $status = null;
        $project = Post::where('post_url', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        $vendors = Supplier::where('tenant_id', Auth::user()->tenant_id)->get();
				$clients = Client::where('tenant_id', Auth::user()->tenant_id)->get();
				$budgets = ProjectBudget::where('project_id', $project->id)->where('tenant_id', Auth::user()->tenant_id)->get();
        $billNo = null;
				$bill = BillMaster::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->first();
				$policy = Policy::where('tenant_id', Auth::user()->tenant_id)->first();
				$currencies = Currency::all();
				if(!empty($bill)){
							$billNo = $bill->bill_no + 1;
					}else{
							$billNo = 1000;
					}
        if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
            $status = 1; //subscribed for accounting package

            if(!empty($project)){
                $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->select()->get();
                return view('backend.project.bill', [
                    'project'=>$project,
                    'accounts'=>$accounts,
                    'status'=>$status,
                    'clients'=>$clients,
                    'billNo'=>$billNo,
										'vendors'=>$vendors,
										'policy'=>$policy,
										'budgets'=>$budgets,
										'currencies'=>$currencies
                    ]);
            }else{
                session()->flash("error", "<strong>Ooops!</strong> No record found.");
                return back();
            }
        }else{
            $accounts = DB::table(Auth::user()->tenant_id.'_coa')->where('type', 'Detail')->select()->get();
            return view('backend.project.invoice', [
                'project'=>$project,
                'accounts'=>$accounts,
                'status'=>0,
                'clients'=>$clients,
                'billNo'=>$billNo,
								'policy'=>$policy,
								'budgets'=>$budgets,
								'currencies'=>$currencies
                ]);
        }
    }

    public function storeProjectBill(Request $request)
    {
			if($request->setBudget == 1){
				$this->validate($request,[
						'vendor'=>'required',
						'bill_to'=>'required',
						'bill_no'=>'required',
						'issue_date'=>'required|date',
						'budget'=>'required',
						'currency'=>'required'
						//'vendor_invoice'=>'mimes:jpeg,jpg,gif,png'
						]);
				}else{
						$this->validate($request,[
							'vendor'=>'required',
							'bill_to'=>'required',
							'bill_no'=>'required',
							'issue_date'=>'required|date',
							'currency'=>'required'
							//'vendor_invoice'=>'mimes:jpeg,jpg,gif,png'
						]);
				}
        $trans_ref = strtoupper(substr(sha1(time()), 35,40));
				$totalAmount = 0;
				$arrayCount = 0;
         if(!empty($request->total)){
            for($i = 0; $i<count($request->total); $i++){
							if(str_replace(',','',$request->total[$i]) != null){
								$totalAmount += str_replace(',','',$request->total[$i]);
									$arrayCount++;
							}
            }
				}
						if(!empty($request->file('vendor_invoice'))){
							$extension = $request->file('vendor_invoice');
							$extension = $request->file('vendor_invoice')->getClientOriginalExtension(); // getting excel extension
							$dir = 'assets/uploads/attachments/';
							$filename = 'vendor_invoice_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
							$request->file('vendor_invoice')->move(public_path($dir), $filename);
					}else{
							$filename = '';
					}
				$ref_no = strtoupper(substr(sha1(time()), 32,40));
        $policy = Policy::where('tenant_id', Auth::user()->tenant_id)->first();
        $bill = new BillMaster;
        $bill->tenant_id = Auth::user()->tenant_id;
        $bill->vendor_id = $request->vendor;
        $bill->bill_no = $request->bill_no;
        $bill->project_id = $request->projectId;
        $bill->bill_date = $request->issue_date;
        $bill->bill_amount = $request->currency != Auth::user()->tenant->currency->id ? ($totalAmount * $request->exchange_rate + ($totalAmount*$policy->vat)/100 * $request->exchange_rate ) : ($totalAmount + ($totalAmount*$policy->vat)/100 ) ;
        $bill->vat_amount = $request->currency != Auth::user()->tenant->currency->id ? ($totalAmount * $policy->vat)/100 * $request->exchange_rate : ($totalAmount*$policy->vat)/100;
        $bill->vat_charge = $policy->vat;
				$bill->billed_to = $request->vendor;
				$bill->currency_id = $request->currency;
				$bill->exchange_rate = $request->exchange_rate;
        $bill->instruction = $request->payment_instruction;
				$bill->user_id = Auth::user()->id;
				$bill->attachment = $filename;
        $bill->slug = substr(sha1(time()), 32,40);
        $bill->save();
				$billId = $bill->id;
				/* #project budget table
				$budget = ProjectBudget::where('project_id', $request->projectId)
									->where('tenant_id', Auth::user()->tenant_id)
									->where('id', $request->budget)
									->first();
						if(!empty($budget)){
							$budget->actual_amount += $totalAmount;
							$budget->save();
						} */

        for($n = 0; $n < $arrayCount; $n++){
            $details = new BillDetail;
            $details->tenant_id = Auth::user()->tenant_id;
            $details->bill_id = $billId;
            $details->description = $request->description[$n];
            $details->quantity = $request->quantity[$n];
            $details->glcode = $request->account[$n];
            $details->amount = $request->currency != Auth::user()->tenant->currency->id ? str_replace(',','',$request->total[$n]) * $request->exchange_rate : str_replace(',','',$request->total[$n]);
            $details->save();
				}
				#update budgetFinance
				$budgetFinance = new BudgetFinance;
				$budgetFinance->project_id = $request->projectId;
				$budgetFinance->bill_id = $billId;
				$budgetFinance->budget_id = $request->budget;
				$budgetFinance->tenant_id = Auth::user()->tenant_id;
				$budgetFinance->save();
				if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
        #Vendor
        $vendor = Supplier::where('tenant_id', Auth::user()->tenant_id)->where('id', $request->vendor)->first();
        $vendorGl = [
            'glcode'=>$vendor->glcode,
            'posted_by'=>Auth::user()->id,
            'narration'=>'Bill raised for '.$vendor->company_name,
            'dr_amount'=>0,
            'cr_amount'=>$request->currency != Auth::user()->tenant->currency->id ? $totalAmount*$request->exchange_rate : $totalAmount,
            'ref_no'=>$ref_no,
            'bank'=>0,
            'ob'=>0,
            'transaction_date'=>now(),
            'created_at'=>now()
        ];
        #Register customer in GL table
        DB::table(Auth::user()->tenant_id.'_gl')->insert($vendorGl);
        #Vat
        $vatGl = [
            'glcode'=>$policy->glcode,
            'posted_by'=>Auth::user()->id,
            'narration'=>'VAT charged on bill no: '.$request->bill_no.' for vendor '.$vendor->company_name,
            'dr_amount'=>0,
            'cr_amount'=>$request->currency != Auth::user()->tenant->currency->id ? ($totalAmount * $policy->vat)/100 * $request->exchange_rate : ($totalAmount * $policy->vat)/100,
            'ref_no'=>$ref_no,
            'bank'=>0,
            'ob'=>0,
            'transaction_date'=>now(),
            'created_at'=>$request->issue_date,
        ];
        #Register VAT in GL table
        DB::table(Auth::user()->tenant_id.'_gl')->insert($vatGl);
        #Service
        $services = BillDetail::where('tenant_id', Auth::user()->tenant_id)->where('bill_id',$billId)->get();
        foreach($services as $serve){
            $serviceGl = [
                'glcode'=>$serve->glcode,
                'posted_by'=>Auth::user()->id,
                'narration'=>"Bill raised for ".$vendor->vendor_name." Service ID: ".$serve->description,
                'dr_amount'=> ($serve->amount * $policy->vat)/100 + $serve->amount,
                'cr_amount'=>0,
                'ref_no'=>$ref_no,
                'bank'=>0,
                'ob'=>0,
                'transaction_date'=>now(),
                'created_at'=>$request->issue_date,
            ];
            #Register service in GL table
            DB::table(Auth::user()->tenant_id.'_gl')->insert($serviceGl);
				}
			}
        session()->flash("success", "<strong>Success!</strong> New Bill registered.");
        return redirect()->route('vendor-bills');
    }

    public function getProjectBudget(Request $request){
        $this->validate($request,[
            'budget'=>'required'
        ]);
        $budget = ProjectBudget::where('id', $request->budget)->first();
        if(!empty($budget)){
            return view('backend.project.common._budget-table', ['budget'=>$budget]);
        }
		}


		public function projectFinancials($slug){
			$project = Post::where('tenant_id', Auth::user()->tenant_id)->where('post_url', $slug)->first();
			if(!empty($project)){
				return view('backend.project.project-financials', ['project'=>$project]);
			}else{
				return back();
			}
		}

}
