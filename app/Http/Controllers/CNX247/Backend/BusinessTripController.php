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

class BusinessTripController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
    * Load Expense request index page
    */
    public function index(){
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
        return view('backend.workflow.business.business-trip', ['storage_capacity' => $storage]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after_or_equal:start_date'
        ]);
        $processor = RequestApprover::select('user_id')
                                    ->where('request_type', 'business-trip')
                                    ->where('depart_id', Auth::user()->department_id)
                                    ->where('tenant_id', Auth::user()->tenant_id)
                                    ->first();
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
        $business = new Post;
        $business->post_title = $request->title;
        $business->budget = $request->amount;
        $business->currency = $request->currency;
        $business->post_type = 'business-trip';
        $business->post_content = $request->purpose;
        $business->location = $request->destination;
        $business->start_date = $request->start_date;
        $business->end_date = $request->end_date;
        $business->post_status = 'in-progress';
        $business->user_id = Auth::user()->id;
        $business->tenant_id = Auth::user()->tenant_id;
        $business->post_url = $url;
        $business->save();
        $id = $business->id;
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
        $event->post_type = 'business-trip';
        $event->user_id = $processor->user_id;
        $event->tenant_id = Auth::user()->tenant_id;
        $event->save();
        $user = User::find($processor->user_id);
        $user->notify(new NewPostNotification($business));

        //Register business process log
        $log = new BusinessLog;
        $log->request_id = $id;
        $log->user_id = Auth::user()->id;
        $log->note = "Approval for business trip ".$request->title." registered.";
        $log->name = "Registering business trip";
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

        session()->flash("success", "Business trip saved.");
     return response()->json(['message'=>'Success! Business trip  submitted.']);
    }
}
