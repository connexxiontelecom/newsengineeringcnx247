<?php

namespace App\Http\Livewire\Backend\Task;

use Livewire\Component;
use App\Post;
use App\ResponsiblePerson;
use App\Observer;
use App\Participant;
use App\PostLike;
use App\PostComment;
use App\PostRevision;
use App\PostAttachment;
use App\PostSubmissionAttachment;
use App\User;
use Auth;

class ViewTask extends Component
{
    public $task;
    public $users;
    public $comment;
    public $likes;
    public $link;
    public $review;
    public $leave_review;
    public $rating;
    public $revisionId;
    public $submittedBy;
    public $appraisal;
    public $attachments;
    public $submissionAttachments;
    public $taskId;
    public $submissionId;
    public $submissionStatus = 0;
    public $taskReview;
    public $taskRating;
    public function render()
    {
        return view('livewire.backend.task.view-task');
    }

    public function mount($url = ''){
        $this->link = request('url', $url);
        $this->getContent();
    }

    /*
    * Comment on post
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

    public function submitReview(){
        $this->validate([
            'leave_review'=>'required',
            'rating'=>'required',
            'revisionId'=>'required',
            'submittedBy'=>'required',
        ]);
    }
    /*
    * Review task
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
    * Load content
    */
    public function getContent(){
        $this->task = Post::where('post_type', 'task')
                            ->where('post_url', $this->link)
                            ->where('tenant_id',Auth::user()->tenant_id)->first();
        $this->attachments = PostAttachment::where('post_id', $this->task['id'])->where('tenant_id', Auth::user()->tenant_id)->get();
        $this->submissionAttachments = PostSubmissionAttachment::where('post_id', $this->task['id'])->where('tenant_id', Auth::user()->tenant_id)->get();
        $this->users = User::select('first_name', 'surname', 'id')->where('account_status',1)->where('verified', 1)
        ->where('tenant_id',Auth::user()->tenant_id)
        ->orderBy('first_name', 'ASC')->get();
/* $priorities = Priority::all();
$statuses = Status::all();
return view('backend.tasks.view-task',[
'users'=>$users,
'priorities'=>$priorities,
'statuses'=>$statuses
]); */
		}


    public function markAsComplete($id){
        $task = Post::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $task->post_status = 'completed';
        $task->save();
        session()->flash("success", "<strong>Success!</strong> Task marked as completed.");
        $this->getContent();
        return back();
    }
    public function markAsRisk($id){
        $task = Post::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $task->post_status = 'at-risk';
        $task->save();
        session()->flash("success", "<strong>Success!</strong> Task marked as At-Risk.");
        $this->getContent();
        return back();
    }

    public function markAsHold($id){
        $task = Post::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $task->post_status = 'on-hold';
        $task->save();
        session()->flash("success", "<strong>Success!</strong> Task marked as On-Hold.");
        $this->getContent();
        return back();
    }


    public function markAsResolved($id){
        $task = Post::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $task->post_status = 'resolved';
        $task->save();
        session()->flash("success", "<strong>Success!</strong> Task marked as Resolved.");
        $this->getContent();
        return back();
    }


    public function markAsClosed($id){
        $task = Post::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $task->post_status = 'closed';
        $task->save();
        session()->flash("success", "<strong>Success!</strong> Task marked as Closed.");
        $this->getContent();
        return back();
    }


    public function removeResponsiblePerson($participant)
    {
        $responsiblePerson =  ResponsiblePerson::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $this->task->id)->first();
        if(!empty($responsiblePerson)) {
        $responsiblePerson->delete();
        }
        $this->getContent();
        return back();
        //return redirect()->route('view-task', ["url" => $request->url]);
    }



    public function removeObserver($participant)
    {
        $responsiblePerson =  Observer::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $this->task->id)->first();
        if(!empty($responsiblePerson)) {
        $responsiblePerson->delete();
        }
        $this->getContent();
        return back();
        //return redirect()->route('view-task', ["url" => $request->url]);
    }



    public function removeParticipant($participant)
    {
        $responsiblePerson =  Participant::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $this->task->id)->first();
        if(!empty($responsiblePerson)) {
        $responsiblePerson->delete();
        }
        $this->getContent();
        return back();
        //return redirect()->route('view-task', ["url" => $request->url]);
    }




    public function approveSubmission($id){
        $this->submissionStatus = 1;
        $this->submissionId = $id;
    }


}
