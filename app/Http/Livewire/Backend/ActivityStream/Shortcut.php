<?php

namespace App\Http\Livewire\Backend\ActivityStream;
use App\Driver;
use App\FileModel;
use App\PostAttachment;
use App\WorkgroupAttachment;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\Component;
use App\Notifications\NewPostNotification;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\BusinessLog;
use App\Post;
use App\PostView;
use App\PostComment;
use App\PostLike;
use App\ResponsiblePerson;
use App\RequestApprover;
use App\Participant;
use App\Observer;
use App\User;
use DatePeriod;
use Auth;
use Hash;


class Shortcut extends Component
{
    use WithPagination;
    //public $posts = [];
    public $ongoing, $following, $assisting, $set_by_me;
    public $birthdays;
    public $next_birthdays;
    //public $events;
    public $verificationCode;
    public $actionStatus = 0;
    public $verificationPostId;
    //public $announcements = [];
    public $all_employees = true;
    public $compose_message;
    public $pId ;
    public $comment;
    public $likes;
    public $users = [];
    public $online;
    public $workforce;
    public $transactionPassword;
    public $userAction; //approved/declined
    public $onlineCounter = 0;
    public $storage;
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


				$now = Carbon::now();
				$date = Carbon::now();
				$this->birthdays = User::where('tenant_id', Auth::user()->tenant_id)
																->where('account_status', '=', 1)
												->whereMonth('birth_date', '>', $date->month)
										->orWhere(function($query) use ($date){
										$query->WhereMonth('birth_date','=', $date->month)
										->whereDay('birth_date', '>=', $date->day);
									})->orderByRaw('DATE_FORMAT(birth_date, "%m-%d")', 'ASC')
									->take(5)
									->get();
			$this->next_birthdays = User::where('tenant_id', Auth::user()->tenant_id)
												->where('account_status','=', 1)
												->whereMonth('birth_date', '=', $date->addMonths(1)->month)
										->orWhere(function($query) use ($date){
										$query->WhereMonth('birth_date','=', $date->month)
										->whereDay('birth_date', '>=', $date->day);
									})->orderByRaw('DATE_FORMAT(birth_date, "%m-%d")', 'ASC')
									->take(5)
									->get();
					$events = Post::where('post_type', 'event')
									->where('tenant_id', Auth::user()->tenant_id)
									->get();
									$eventIds = [];
									foreach($events as $event){
									array_push($eventIds, $event->id);
									}
									$mine = ResponsiblePerson::where('tenant_id', Auth::user()->tenant_id)
															->whereIn('post_id', $eventIds)->orWhere('post_id', 32)->get();
									$mineIds = [];
									foreach($mine as $m){
									array_push($mineIds, $m->post_id);
									}
				$my_events = Post::where('tenant_id', Auth::user()->tenant_id)->whereIn('id', $mineIds)
													->whereDate('start_date', '>', now())
													->take(5)
													->orderBy('end_date', 'DESC')->get();
        $this->ongoing = ResponsiblePerson::where('status','in-progress')
																->where('tenant_id', Auth::user()->tenant_id)
																->where('post_type', 'task')
                                ->where('user_id', Auth::user()->id)
                                ->count();
        $this->set_by_me = Post::where('user_id',Auth::user()->id)
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->where('post_type', 'task')
                                ->count();
        $this->assisting = Participant::where('user_id',Auth::user()->id)
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->count();
        $this->following = Observer::where('user_id',Auth::user()->id)
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->count();
				$current = strtotime($now->today());
				//get all tenant posts
				$posts = Post::where('tenant_id', Auth::user()->tenant_id)
										->get();
							$postIds = [];
							foreach($posts as $post){
							array_push($postIds, $post->id);
							}

				$created_by_me = Post::where('tenant_id', Auth::user()->tenant_id)->where('user_id', Auth::user()->id)->get();

				//this IDs very important
				$createdByMeIds = [];
				foreach($created_by_me as $by_me){
					array_push($createdByMeIds, $by_me->id);
				}

				$mine = ResponsiblePerson::where('tenant_id', Auth::user()->tenant_id)->whereIn('post_id', $postIds)
																	->where('user_id', Auth::user()->id)
																	->orWhere('user_id', 32)->get();

																														//same with this
				$mineIds = [];
				foreach($mine as $m){
				array_push($mineIds, $m->post_id);
				}

				//join the two IDs (post created by me and ones that I'm responsible for)
				$mergedIds = array_unique(array_merge($createdByMeIds, $mineIds));

				$my_posts = Post::select('post_title as title', 'start_date as start', 'end_date as end', 'post_color as color')
													->where('post_type', 'event')
													->where('tenant_id', Auth::user()->tenant_id)
													->whereIn('id', $mineIds)->orderBy('end_date', 'DESC')->get();


        $this->online = User::where('tenant_id', Auth::user()->tenant_id)->where('is_online', 1)->count();
				$this->workforce = User::where('tenant_id', Auth::user()->tenant_id)->count();

        return view('livewire.backend.activity-stream.shortcut',
                                ['posts'=> Post::where('tenant_id', Auth::user()->tenant_id)->whereIn('id',$mergedIds)
                                ->orderBy('id', 'DESC')
                                ->paginate(10),
                    'announcements'=>Post::where('post_type', 'announcement')
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->orderBy('id', 'DESC')->take(5)->get(),
                                'events'=>$my_events,
																	'storage_capacity' => $storage,

        ]);
    }

    public function mount(){
        $this->getContent();
    }
    /*
    * Get content
    */
    public function getContent(){
        $this->users = User::where('tenant_id', Auth::user()->tenant_id)->orderBy('first_name', 'ASC')->get();
    }

    /*
    * Send message
    */
    public function sendMessage(){

    }

    /*
    * Toggle choice
    */
    public function toAllEmployees(){
        !$this->all_employees;
    }

    /*
    * Comment on post
    */
    public function comment($id){
        $this->validate([
            'id'=>'required',
            'comment'=>'required'
        ]);
        $com = new PostComment;
        $com->user_id = Auth::user()->id;
        $com->post_id = $id;
        $com->comment = $this->comment;
        $com->tenant_id = Auth::user()->tenant_id;
        $com->save();
        $this->comment = '';
    }

    /*
    *Like post
    */
    public function addLike($id){
        $this->validate([
            'id'=>'required'
        ]);
        $like = new PostLike;
        $like->user_id = Auth::user()->id;
        $like->post_id = $id;
        $like->tenant_id = Auth::user()->tenant_id;
        $like->save();
    }
    /*
    *Unlike post
    */
    public function unLike($id){
        $this->validate([
            'id'=>'required'
        ]);
        $unlike = PostLike::where('post_id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->where('tenant_id',Auth::user()->tenant_id)->first();
        $unlike->delete();
    }

         /*
    * Approve request
    */
    public function approveRequest($id){
        $this->actionStatus = 1;
        $this->verificationPostId = $id;
        $this->userAction = 'approved';
        session()->flash("success_code", "Kindly enter your transaction password to confirm this action. <small>You can set a new transaction password by following: Profile > Settings > Security.</small>");

    }

    /*
    * Decline request
    */
    public function declineRequest($id){
        $this->actionStatus = 1;
        $this->verificationPostId = $id;
        $this->userAction = 'declined';
        session()->flash("success_code", "Kindly enter your transaction password to confirm this action. <small>You can set a new transaction password by following: Profile > Settings > Security.</small>");
    }

    public function clockIn($id){

    }
    public function verifyCode($id){
        $this->validate([
            'transactionPassword'=>'required'
        ]);
        if (Hash::check($this->transactionPassword, Auth::user()->transaction_password)) {
            $details = Post::find($id);
            if($this->userAction == 'approved'){
                $action = ResponsiblePerson::where('post_id', $id)->where('user_id', Auth::user()->id)->first();
                $action->status = $this->userAction;
                $action->save();
                //Register business process log
                $log = new BusinessLog;
                $log->request_id = $id;
                $log->user_id = Auth::user()->id;
                $log->name = $this->userAction;
                $log->note = str_replace('-', ' ',$details->post_type)." ".$this->userAction." by ".Auth::user()->first_name." ".Auth::user()->surname ?? " ";
                $log->save();
                $responsiblePersons = ResponsiblePerson::where('post_id', $id)
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
                $supervise->request_id = $id;
                $supervise->user_id = Auth::user()->id;
                $supervise->name = 'Log entry';
                $supervise->note = "Identifying next processor for ".str_replace('-', ' ',$details->post_type).": ".$details->post_title;
                $supervise->save();
                //Assign next processor
                if(!empty($remainingProcessors) ){
                    $reset = array_values($remainingProcessors);
                    for($i = 0; $i<count($reset); $i++){
                        $next = new ResponsiblePerson;
                        $next->post_id = $id;
                        $next->post_type = $details->post_type;
                        $next->user_id = $reset[$i];
                        $next->tenant_id = Auth::user()->tenant_id;
                        $next->save();
                        $user = User::find($reset[$i]);
                        $user->notify(new NewPostNotification($details));
                    break;
                    }
                }else{
                    $status = Post::find($id);
                    $status->post_status = $this->userAction;
                    $status->save();
                    #Requisition to GL flow takes over from here
                }
                $this->actionStatus = 0;
                $this->verificationPostId = null;
                $this->getContent();
                session()->flash("done", "<p class='text-success text-center'>Request verified successfully.</p>");
            }else{
                $action = ResponsiblePerson::where('post_id', $id)->where('user_id', Auth::user()->id)->first();
                $action->status = $this->userAction;
                $action->save();
                //Register business process log
                $log = new BusinessLog;
                $log->request_id = $id;
                $log->user_id = Auth::user()->id;
                $log->name = $this->userAction;
                $log->note = str_replace('-', ' ',$details->post_type)." ".$this->userAction." by ".Auth::user()->first_name." ".Auth::user()->surname;
                $log->save();
                 //update request table finally
                 $status = Post::find($id);
                 $status->post_status = $this->userAction;
                 $status->save();
                    $this->actionStatus = 0;
                    $this->verificationPostId = null;
                    $this->getContent();
                    session()->flash("done", "<p class='text-success text-center'>Request verified successfully.</p>");
            }
        }else{
            session()->flash("error_code", "<strong>Ooops!</strong>  Mis-match transaction password. Try again. <small>You can set a new transaction password by following: Profile > Settings > Security.</small>");
        }

    }
}
