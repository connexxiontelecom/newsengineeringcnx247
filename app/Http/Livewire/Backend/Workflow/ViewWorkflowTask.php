<?php

namespace App\Http\Livewire\Backend\Workflow;

use Livewire\Component;
use App\Post;
use App\PostComment;
use App\PostAttachment;
use App\PostRevision;
use App\RequestApprover;
use App\ResponsiblePerson;
use App\BusinessLog;
use Carbon\Carbon;
use App\Notifications\NewPostNotification;
use App\User;
use Auth;
use Hash;

class ViewWorkflowTask extends Component
{
    public $link;
    public $comment;
    public $likes;
    public $review;
    public $request;
    public $attachments;

    public $transactionPassword;
    public $userAction; //approved/declined
    public $actionStatus = 0;
    public $verificationPostId;

    public function render()
    {
        return view('livewire.backend.workflow.view-workflow-task');
    }

    public function mount($url = ''){
        $this->link = request('url', $url);
        $this->getContent();
    }

    /*
    * Load content
    */
    public function getContent(){
        $this->request = Post::where('post_url', $this->link)->where('tenant_id',Auth::user()->tenant_id)->first();
        $this->attachments = PostAttachment::where('post_id', $this->request->id)
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->get();
    }

    /*
    * Comment on request
    */
    public function leaveCommentBtn($id){
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
        $this->getContent();
    }
    /*
    * Review request
    */
    public function leaveReviewBtn($id){
        $this->validate([
            'id'=>'required',
            'review'=>'required'
        ]);
        $com = new PostRevision;
        $com->user_id = Auth::user()->id;
        $com->post_id = $id;
        $com->content = $this->review;
        $com->tenant_id = Auth::user()->tenant_id;
        $com->save();
        $this->review = '';
        $this->getContent();
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
