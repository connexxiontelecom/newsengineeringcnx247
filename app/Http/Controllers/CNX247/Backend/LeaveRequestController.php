<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\NewPostNotification;
use App\BusinessLog;
use App\PostAttachment;
use App\RequestApprover;
use App\ResponsiblePerson;
use App\Post;
use App\User;
use Auth;

class LeaveRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
    * Load Expense request index page
    */
    public function index(){

        return view('backend.workflow.leave.leave-request');
    }

    public function store(Request $request){
            $this->validate($request, [
                'start_date'=>'required|date',
                'end_date'=>'required|date|after_or_equal:start_date',
                'absence_type'=>'required',
                'reason'=>'required'
            ]);
    $processor = RequestApprover::select('user_id')
            ->where('request_type', 'leave-request')
            ->where('depart_id', Auth::user()->department_id)
            ->where('tenant_id', Auth::user()->tenant_id)
            ->first();
    if(empty($processor)){
                session()->flash("error", "<strong>Ooops!</strong> Could not submit request. Either there's no processor for your department or you need to update your profile.");
                return back();
            }else{

                if(!empty($request->file('attachment'))){
                    $extension = $request->file('attachment');
                    $extension = $request->file('attachment')->getClientOriginalExtension();
                    $size = $request->file('attachment')->getSize();
                    $dir = 'assets/uploads/requisition/';
                    $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
                    $request->file('attachment')->move(public_path($dir), $filename);
                }else{
                    $filename = '';
                }
                $url = substr(sha1(time()), 10,10);
                $requisition = new Post;
                $requisition->post_title = 'Leave Request';
                $requisition->post_type = 'leave-request';
                $requisition->post_content = $request->reason;
                $requisition->start_date = $request->start_date;
                $requisition->end_date = $request->end_date;
                $requisition->post_status = 'in-progress';
                $requisition->user_id = Auth::user()->id;
                $requisition->tenant_id = Auth::user()->tenant_id;
                $requisition->post_url = $url;
                $requisition->save();
                $id = $requisition->id;
                if(!empty($request->file('attachment'))){
                    $attachment = new PostAttachment;
                    $attachment->post_id = $id;
                    $attachment->user_id = Auth::user()->id;
                    $attachment->tenant_id = Auth::user()->tenant_id;
                    $attachment->attachment = $filename;
                    $attachment->save();
                }
                $event = new ResponsiblePerson;
                $event->post_id = $id;
                $event->post_type = 'leave-request';
                $event->user_id = $processor->user_id;
                $event->tenant_id = Auth::user()->tenant_id;
                $event->save();
                $user = User::find($processor->user_id);
                $user->notify(new NewPostNotification($requisition));


                //Register business process log
                $log = new BusinessLog;
                $log->request_id = $id;
                $log->user_id = Auth::user()->id;
                $log->note = "Approval for leave request ".$request->title." registered.";
                $log->name = "Registering leave request";
                $log->tenant_id = Auth::user()->tenant_id;
                $log->save();

                //identify supervisor
                $supervise = new BusinessLog;
                $supervise->request_id = $id;
                $supervise->user_id = Auth::user()->id;
                $supervise->name = "Log entry";
                $supervise->note = "Identifying processor for ".Auth::user()->first_name." ".Auth::user()->surname;
                $supervise->tenant_id = Auth::user()->tenant_id;
                $supervise->save();

                session()->flash("success", "<strong>Success!</strong> Leave request saved.");
             return back();
            }
    }
}
