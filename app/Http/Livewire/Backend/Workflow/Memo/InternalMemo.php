<?php

namespace App\Http\Livewire\Backend\Workflow\Memo;

use App\Driver;
use App\FileModel;
use App\PostAttachment;
use App\WorkgroupAttachment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\RequestTable;
use App\BusinessLog;
use App\RequestActivityLog;
use App\RequestApprover;
use App\ResponsiblePerson;
use App\Post;
use App\User;
use App\Department;
use Auth;

class InternalMemo extends Component
{
    public $subject, $receiver;
    public $content, $attachment;
    public $users, $departments;
    public $target = 'all';
    public $department = 1; //selected department ID


    public function render()
    {
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
        return view('livewire.backend.workflow.memo.internal-memo', ['storage_capacity' => $storage]);
    }

    public function mount(){
        $this->departments = Department::orderBy('department_name', 'ASC')->where('tenant_id',Auth::user()->tenant_id)->get();
        $this->users = User::orderBy('first_name', 'ASC')->where('tenant_id',Auth::user()->tenant_id)->get();
    }

    /*
    * Submit internal memo
    */
    public function submitInternalMemo(){
        $this->validate([
            'subject'=>'required',
            'content'=>'required'
        ]);
        $url = substr(sha1(time()), 10,10);
        $memo = new Post;
        $memo->post_title = $this->subject;
        $memo->post_content = $this->content;
        $memo->post_type = 'memo';
        $memo->post_status = 'in-progress';
        $memo->user_id = Auth::user()->id;
        $memo->post_url = $url;
        $memo->tenant_id = Auth::user()->tenant_id;
        $memo->save();
        $id = $memo->id;

        if($this->target == 'all'){
            $res = new ResponsiblePerson;
            $res->user_id = 32; // to all employees
            $res->post_id = $id;
            $res->tenant_id = Auth::user()->tenant_id;
            $res->save();
            session()->flash("success", "Internal memo sent.");
            return response()->json(['message'=>'Success! Internal memo sent.']);
        }else if($this->target == 'department'){
            $users = User::select('id')->where('department_id', $this->department)->get();
            foreach($users as $user){
                $res = new ResponsiblePerson;
                $res->user_id = $user->id; // to all employees
                $res->post_id = $id;
                $res->tenant_id = Auth::user()->tenant_id;
                $res->save();
            }
            session()->flash("success", "Internal memo sent.");
            return response()->json(['message'=>'Success! Internal memo sent.']);
        }
    }








        //submit leave request
        public function submitLeaveRequest(){
            //return dd($this->attachment);
            $this->validate([
                'start_date'=>'required',
                'due_date'=>'required',
                'absence_type'=>'required',
                'reason'=>'required'
            ]);

        /*if(!empty($request->file('attachment'))){
                $extension = $request->file('attachment');
                $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
                $dir = 'assets/request-attachments/';
                $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
                $request->file('attachment')->move(public_path($dir), $filename);
            }else{
                $filename = '';
            } */
            $url = substr(sha1(time()), 10,10);
            $expense = new Post;
            $expense->post_title = 'Leave request';
            $expense->post_content = $this->reason;
            $expense->start_date = $this->start_date;
            $expense->end_date = $this->due_date;
            $expense->post_type = 'leave-request';
            $expense->post_status = 'in-progress';
            $expense->user_id = Auth::user()->id;
            $expense->post_url = $url;
            $expense->tenant_id = Auth::user()->tenant_id;
            //$expense->attachment = $filename ?? '';
            $expense->save();
            $id = $expense->id;

            //Register business process log
            $log = new BusinessLog;
            $log->request_id = $id;
            $log->user_id = Auth::user()->id;
            $log->note = "Approval for Leave request ".$this->reason;
            $log->name = "Approval";
            $log->tenant_id = Auth::user()->tenant_id;
            $log->save();

            //identify supervisor
            $supervise = new BusinessLog;
            $supervise->request_id = $id;
            $supervise->user_id = Auth::user()->id;
            $supervise->name = "Log entry";
            $supervise->note = "Identifying supervisor for ".Auth::user()->first_name." ".Auth::user()->surname;
            $supervise->tenant_id = Auth::user()->tenant_id;
            $supervise->save();

            session()->flash("success", "Leave request saved.");
         return response()->json(['message'=>'Success! Leave request submitted.']);
        }
}
