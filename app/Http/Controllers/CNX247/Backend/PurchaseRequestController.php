<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Driver;
use App\FileModel;
use App\Http\Controllers\Controller;
use App\WorkgroupAttachment;
use Illuminate\Http\Request;
use App\Notifications\NewPostNotification;
use App\BusinessLog;
use App\PostAttachment;
use App\RequestApprover;
use App\ResponsiblePerson;
use App\Post;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

class PurchaseRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
    * Load Expense request index page
    */
    public function index(){
    	$users = User::where('tenant_id', Auth::user()->tenant_id)->where('account_status', 1)->get();
			$plan_details = DB::table('plan_features')
				->where('plan_id', '=', Auth::user()->tenant->plan_id)
				->first();

			$storage_size = $plan_details->storage_size;

			$size = FileModel::where('tenant_id', Auth::user()->tenant_id)
				->where('uploaded_by', Auth::user()->id)->sum('size');

			$postAttachments = PostAttachment::where('tenant_id', Auth::user()->tenant_id)->get();

			$sum_post_attachment = 0;
			foreach ($postAttachments as $postAttachment):
				if(file_exists(public_path('assets\uploads\attachments\\'.$postAttachment->attachment))):
					$fileSize = \File::size(public_path('assets\uploads\attachments\\'.$postAttachment->attachment));
					//echo $fileSize;
					$sum_post_attachment = $sum_post_attachment + $fileSize;
				endif;
			endforeach;

			$workgroupAttachments = WorkgroupAttachment::where('tenant_id', Auth::user()->tenant_id)->get();

			$sum_workgroup_attachment = 0;
			foreach ($workgroupAttachments as $workgroupAttachment):
				if(file_exists(public_path('assets\uploads\attachments\\'.$workgroupAttachment->attachment))):
					$fileSize = \File::size(public_path('assets\uploads\attachments\\'.$workgroupAttachment->attachment));

					$sum_workgroup_attachment = $sum_workgroup_attachment + $fileSize;
				endif;

			endforeach;

			$drivers = Driver::where('tenant_id', Auth::user()->tenant_id)->get();

			$sum_driver_attachment = 0;

			foreach($drivers as $driver):
				if(file_exists(public_path('assets\uploads\logistics\\'.$driver->attachment))):
					$fileSize = \File::size(public_path('assets\uploads\logistics\\'.$driver->attachment));
					//echo $fileSize;
					$sum_driver_attachment = $sum_driver_attachment + $fileSize;
				endif;
			endforeach;


			$size = ($sum_post_attachment + $sum_driver_attachment + $sum_workgroup_attachment + $size)/1000000000;

			if($size >= $storage_size):

				$storage = 0;

			else:

				$storage = 1;

			endif;
        return view('backend.workflow.purchase.index', ['storage_capacity' => $storage, 'users'=>$users]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'amount'=>'required',
						'responsible_person'=>'required'
        ]);
			/*$processor = RequestApprover::select('user_id')
																	->where('request_type', 'purchase-request')
																	->where('depart_id', Auth::user()->department_id)
																	->where('tenant_id', Auth::user()->tenant_id)
																	->first();
			if(empty($processor)){
					return response()->json(["error"=>"Error! Could not submit. No processor found."],400);
			}else{*/
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
            $requisition->post_title = $request->title;
            $requisition->budget = $request->amount;
            $requisition->currency = $request->currency;
            $requisition->post_type = 'purchase-request';
            $requisition->post_content = $request->description;
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
            $event->post_type = 'purchase-request';
            $event->user_id = $request->responsible_person;
            $event->tenant_id = Auth::user()->tenant_id;
            $event->save();
            $user = User::find($request->responsible_person);
            $user->notify(new NewPostNotification($requisition));

            //Register business process log
            /*$log = new BusinessLog;
            $log->request_id = $id;
            $log->user_id = Auth::user()->id;
            $log->note = "Approval for purchase request ".$request->title." registered.";
            $log->name = "Registering purchase request";
            $log->tenant_id = Auth::user()->tenant_id;
            $log->save();*/

            //identify supervisor
           /* $supervise = new BusinessLog;
            $supervise->request_id = $id;
            $supervise->user_id = Auth::user()->id;
            $supervise->name = "Log entry";
            $supervise->note = "Identifying processor for ".Auth::user()->first_name." ".Auth::user()->surname;
            $supervise->tenant_id = Auth::user()->tenant_id;
            $supervise->save();*/

            session()->flash("success", "Purchase request saved.");
         return response()->json(['message'=>'Success! Purchase request  submitted.']);

        //}
    }
}
