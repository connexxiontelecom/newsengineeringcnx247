<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\RequestApprover;
use App\ResponsiblePerson;
use App\BusinessLog;
use App\Department;
use App\Post;
use App\User;
use Auth;
use Hash;

class WorkflowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
    * Load index page [my assignments]
    */
    public function index(){
			$requests = Post::whereIn('post_type',
            ['purchase-request', 'expense-report',
                'leave-request', 'business-trip',
                'general-request'])
            ->where('tenant_id',Auth::user()->tenant_id)
						->orderBy('id', 'DESC')
						->paginate(10);
			$my_requests = Post::whereIn('post_type',
						['purchase-request', 'expense-report',
						'leave-request', 'business-trip',
						'general-request'])
						//->where('post_status', 'in-progress')
						->where('user_id', Auth::user()->id)
						->where('tenant_id',Auth::user()->tenant_id)
						->orderBy('id', 'DESC')
						->paginate(10);
						$now = Carbon::now();
						$overall = Post::whereIn('post_type',
																['purchase-request', 'expense-report',
																'leave-request', 'business-trip',
																'general-request'])
																->where('tenant_id',Auth::user()->tenant_id)
																->where('post_status', 'approved')
																->sum('budget');
						$thisYear = Post::whereIn('post_type',
																['purchase-request', 'expense-report',
																'leave-request', 'business-trip',
																'general-request'])
																->where('tenant_id',Auth::user()->tenant_id)
																->where('post_status', 'approved')
																->whereYear('created_at', date('Y'))
																->sum('budget');
						$thisMonth = Post::whereIn('post_type',
																['purchase-request', 'expense-report',
																'leave-request', 'business-trip',
																'general-request'])
																->where('tenant_id',Auth::user()->tenant_id)
																->where('post_status', 'approved')
																->whereMonth('created_at', date('m'))
																->whereYear('created_at', date('Y'))
																->sum('budget');
						$lastMonth = Post::whereIn('post_type',
																['purchase-request', 'expense-report',
																'leave-request', 'business-trip',
																'general-request'])
																->where('tenant_id',Auth::user()->tenant_id)
																->where('post_status', 'approved')
																->whereMonth('created_at', '=', $now->subMonth()->month)
																->sum('budget');
        return view('backend.workflow.index',[
					'requests'=>$requests,
					'my_requests'=>$my_requests,
					'overall'=>$overall,
					'lastMonth'=>$lastMonth,
					'thisMonth'=>$thisMonth,
					'thisYear'=>$thisYear
					]);
    }

    /*
    * Workflow task
    */
    public function viewWorkflowTask($url){
        return view('backend.workflow.view');
    }

    public function businessProcess(){
        $approvers = RequestApprover::where('tenant_id',Auth::user()->tenant_id)->get();
        $departments = Department::where('tenant_id',Auth::user()->tenant_id)->get();
        $employees = User::where('tenant_id',Auth::user()->tenant_id)->get();
        return view('backend.workflow.business-process',
        ['approvers'=>$approvers,
        'departments'=>$departments,
        'employees'=>$employees
        ]);
    }
    public function setBusinessProcess(Request $request){
        $this->validate($request,[
            'department'=>'required',
            'processor'=>'required',
            'request_type'=>'required'
        ]);
        $p = new RequestApprover;
        $p->user_id =  $request->processor;
        $p->request_type =  $request->request_type;
        $p->depart_id =  $request->department;
        $p->set_by =  Auth::user()->id;
        $p->approver_stage =  'undefined';
        $p->tenant_id =  Auth::user()->tenant_id;
        $p->save();
        if($p){
            return response()->json(['message'=>'Success! New request processor set.'],200);
        }else{
            return response()->json(['message'=>'Ooops! We could not registere new processor'],400);
        }
		}

		/*
    * approveOrDeclineRequest request
    */
		public function approveOrDeclineRequest(Request $request){
			$this->validate($request,[
				'post'=>'required',
				'transaction_password'=>'required',
				'action'=>'required'
			]);
			$post = $request->post;
			$userAction = $request->action;
			$transactionPassword = $request->transaction_password;

				if (Hash::check($transactionPassword, Auth::user()->transaction_password)) {
					$details = Post::find($post);
					if($userAction == 'approved'){
							$action = ResponsiblePerson::where('post_id', $post)->where('user_id', Auth::user()->id)->first();
							$action->status = $userAction;
							$action->save();
							//Register business process log
							$log = new BusinessLog;
							$log->request_id = $post;
							$log->user_id = Auth::user()->id;
							$log->name = $userAction;
							$log->note = str_replace('-', ' ',$details->post_type)." ".$userAction." by ".Auth::user()->first_name." ".Auth::user()->surname ?? " ";
							$log->save();
							$responsiblePersons = ResponsiblePerson::where('post_id', $post)
																					->where('tenant_id', Auth::user()->tenant_id)
																					->get();
							$responsiblePersonIds = [];
							foreach($responsiblePersons as $per){
								array_push($responsiblePersonIds, $per->user_id);
							}
							//search for processor
							$approvers = RequestApprover::where('request_type', $details->post_type)
																					->where('depart_id', $details->user->department_id)
																					->where('tenant_id', Auth::user()->tenant_id)
																					->get();
							$approverIds = [];
							if(!empty($approvers) ){
									foreach($approvers as $approver){
											array_push($approverIds, $approver->user_id);
									}
							}
							$remainingProcessors = array_diff($approverIds,$responsiblePersonIds);
							//identify next supervisor
							$supervise = new BusinessLog;
							$supervise->request_id = $post;
							$supervise->user_id = Auth::user()->id;
							$supervise->name = 'Log entry';
							$supervise->note = "Identifying next processor for ".str_replace('-', ' ',$details->post_type).": ".$details->post_title;
							$supervise->save();
							//Assign next processor
							if(!empty($remainingProcessors) ){
									$reset = array_values($remainingProcessors);
									for($i = 0; $i<count($reset); $i++){
											$next = new ResponsiblePerson;
											$next->post_id = $post;
											$next->post_type = $details->post_type;
											$next->user_id = $reset[$i];
											$next->tenant_id = Auth::user()->tenant_id;
											$next->save();
											$user = User::find($reset[$i]);
											$user->notify(new NewPostNotification($details));
									break;
									}
							}else{
									$status = Post::find($post);
									$status->post_status = $userAction;
									$status->save();
									#Requisition to GL flow takes over from here
									return response()->json(['message'=>'Success! Request verified successfully.'],200);
							}
					}else{
							$action = ResponsiblePerson::where('post_id', $post)->where('user_id', Auth::user()->id)->first();
							$action->status = $userAction;
							$action->save();
							//Register business process log
							$log = new BusinessLog;
							$log->request_id = $post;
							$log->user_id = Auth::user()->id;
							$log->name = $userAction;
							$log->note = str_replace('-', ' ',$details->post_type)." ".$userAction." by ".Auth::user()->first_name." ".Auth::user()->surname;
							$log->save();
							//update request table finally
							$status = Post::find($post);
							$status->post_status = $userAction;
							$status->save();
							return response()->json(['message'=>'Success! Request verified successfully.'],200);
					}
			} else{
					return response()->json(["error"=>"Mis-match transaction password. Try again. You can set a new transaction password by following: Profile > Settings > Security."],400);
			}

	}


}
