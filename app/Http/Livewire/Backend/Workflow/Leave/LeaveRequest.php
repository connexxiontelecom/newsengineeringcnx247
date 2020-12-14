<?php

namespace App\Http\Livewire\Backend\Workflow\Leave;

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
use App\Post;
use App\LeaveWallet;
use App\LeaveType;
use Auth;

class LeaveRequest extends Component
{
    public $leaves ;
    public $leave_types ;

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
        return view('livewire.backend.workflow.leave.leave-request', ['storage_capacity' => $storage]);
    }
    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $this->leaves = Post::where('user_id', Auth::user()->id)
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->where('post_type', 'leave-request')
                                ->orderBy('id', 'DESC')
                                ->get();
        $this->leave_types = LeaveType::where('tenant_id', Auth::user()->tenant_id)->get();
    }

}
