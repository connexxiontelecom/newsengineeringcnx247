<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\WorkgroupNotification;
use App\Notifications\WorkgroupInviteNotification;
use App\Notifications\NewPostNotification;
use App\WorkgroupPost;
use App\Workgroup;
use App\WorkgroupAttachment;
use App\WorkgroupResponsiblePerson;
use App\WorkgroupObserver;
use App\WorkgroupParticipant;
use App\WorkgroupMember;
use App\WorkgroupModerator;
use App\WorkgroupInvite;
use App\Participant;
use App\Invitation;
use App\Observer;
use App\User;
use Image;
use DB;
use Auth;


class WorkgroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*
    * Load index page [my assignments]
    */
    public function index(){

        return view('backend.workgroup.index');
    }

    /*
    *show create new workgroup form
    */
    public function showNewWorkgroupForm(){
        $users = User::where('tenant_id', Auth::user()->tenant_id)->orderBy('first_name', 'ASC')->get();
        $groups = Workgroup::where('tenant_id',Auth::user()->tenant_id)->orderBy('id', 'DESC')->take(5)->get();
        return view('backend.workgroup.new', ['users'=>$users, 'workgroups'=>$groups]);
    }

    public function storeWorkgroup(Request $request){
        $this->validate($request,[
            'workgroup_name'=>'required',
            'workgroup_members'=>'required',
            'moderators'=>'required',
            'group_image'=>'required|image',
            'description'=>'required'
        ]);
        if($request->hasFile('group_image')){
                $image = $request->file('group_image');
                $filename = time().'.'.$image->getClientOriginalExtension();
                \Image::make($request->group_image)->resize(480, 320)->save(public_path('assets/images/workgroup/medium/').$filename);
                \Image::make($request->group_image)->resize(45, 45)->save(public_path('assets/images/workgroup/thumbnail/').$filename);
                \Image::make($request->group_image)->resize(854, 154)->save(public_path('assets/images/workgroup/cover/').$filename);
        }

        $group = new Workgroup;
        $group->group_name = $request->workgroup_name;
        $group->description = $request->description;
        $group->group_image = $filename ?? '';
        $group->url = substr(sha1(time()),24,40);
        $group->tenant_id = Auth::user()->tenant_id;
        $group->owner = Auth::user()->id;
        $group->save();
        $groupId = $group->id;
        //workgroup members
        if(!empty($request->workgroup_members)){
            foreach($request->workgroup_members as $member){
                $mem = new WorkgroupMember;
                $mem->workgroup_id = $groupId;
                $mem->user_id = $member;
                $mem->request_status = 1; //approved
                $mem->tenant_id = Auth::user()->tenant_id;
                $mem->save();
            }
        }
        //workgroup moderators or responsible persons
        if(!empty($request->moderators)){
            foreach($request->moderators as $moderator){
                $mode = new WorkgroupModerator;
                $mode->workgroup_id = $groupId;
                $mode->user_id = $moderator;
                $mode->request_status = 1; //approved
                $mode->tenant_id = Auth::user()->tenant_id;
                $mode->save();
            }
        }

        session()->flash("success", "<strong>Success!</strong> New workgroup created.");
        return redirect()->route('workgroups');


    }

    /*
    *View workgroup
    */
    public function viewWorkgroup($url){
        $users = User::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.workgroup.view', ['users'=>$users]);
    }

     /*
    * Send message
    */
    public function sendMessage(Request $request){
        $this->validate($request,[
            'message'=>'required'
        ]);
        //return response()->json($request->message_persons);
        $message = new WorkgroupPost;
        $message->post_content = $request->message;
        $message->user_id = Auth::user()->id;
        $message->group_id = $request->groupId;
        $message->post_url = substr(sha1(time()),10,10);
        $message->post_type = 'message';
        $message->tenant_id = Auth::user()->tenant_id;
        $message->save();
        $message_id = $message->id;
        if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'message_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }
        foreach(json_decode($request->message_persons) as $person){
                $receiver = new WorkgroupResponsiblePerson;
                $receiver->user_id = $person;
                $receiver->post_id = $message_id;
                $receiver->tenant_id = Auth::user()->tenant_id;
                $receiver->save();
                //notification
                $user = User::find($person);
                $user->notify(new WorkgroupNotification($message));

            }
            /* foreach($message->responsiblePersons as $per){
                $per
            } */
            //save attachment
            if(!empty($request->file('attachment'))){
                $attach = new WorkgroupAttachment;
                $attach->post_id = $message_id;
                $attach->user_id = Auth::user()->id;
                $attach->attachment = $filename;
                $attach->tenant_id = Auth::user()->tenant_id;
                $attach->save();
            }

        return response()->json(['message'=>'Success! Message sent.']);
    }

    /*
    * Create task
    */
    public function createTask(Request $request){

        $this->validate($request, [
            'task_title'=>'required',
            'responsible_persons'=>'required',
            'task_description'=>'required',
            'due_date'=>'required'
        ]);

        $url = substr(sha1(time()), 10, 10);
        $task = new WorkgroupPost;
        $task->post_title = $request->task_title;
        $task->user_id = Auth::user()->id;
        $task->post_content = $request->task_description;
        $task->post_color = $request->color;
        $task->post_type = 'task';
        $task->post_url = $url;
        $task->group_id = $request->taskGroupId;
        $task->start_date = $request->start_date ?? '';
        $task->end_date = $request->due_date;
        $task->post_priority = $request->priority;
        $task->tenant_id = Auth::user()->tenant_id;
        //$task->attachment = $filename;
        $task->save();
        $task_id = $task->id;
        if(!empty($request->attachment)){
            $filename = Auth::user()->tenant->company_name.'_'.time().date('Y').'.'.$request->attachment->extension();
            $request->attachment->storeAs('task', $filename);
            $post_attachment = new WorkgroupAttachment;
            $post_attachment->attachment = $filename;
            $post_attachment->tenant_id = Auth::user()->tenant_id;
            $post_attachment->workgroup_id = $request->taskGroupId;
            $post_attachment->post_id = $task_id;
            $post_attachment->user_id = Auth::user()->id;
            $post_attachment->save();
        }
        //responsible persons
        if(!empty($request->responsible_persons)){
            foreach($request->responsible_persons as $participant){
                $res = new WorkgroupResponsiblePerson;
                $res->post_id = $task_id;
                $res->user_id = $participant;
                $res->group_id = $request->taskGroupId;
                $res->tenant_id = Auth::user()->tenant_id;
                $res->save();
            }
        }
        //participants
        if(!empty($request->participants)){
            foreach($request->participants as $person){
                $part = new WorkgroupParticipant;
                $part->post_id = $task_id;
                $part->group_id = $request->taskGroupId;
                $part->user_id = $person;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        //observers
        if(!empty($request->observers)){
            foreach($request->observers as $observe){
                $obs = new WorkgroupObserver;
                $obs->post_id = $task_id;
                $obs->group_id = $request->taskGroupId;
                $obs->user_id = $observe;
                $obs->tenant_id = Auth::user()->tenant_id;
                $obs->save();
            }
        }
        session()->flash("success", "<strong>Success!</strong> Workgroup task registered.");
        return redirect()->back();
    }

    /*
    * Create event
    */
    public function createEvent(Request $request){
        //return dd($this->responsible_persons);
        $this->validate($request, [
            'event_name'=>'required',
            'attendees'=>'required',
            'event_description'=>'required',
            'event_start_date'=>'required'
        ]);
        $url = substr(sha1(time()), 10, 10);
        $event = new WorkgroupPost;
        $event->post_title = $request->event_name;
        $event->user_id = Auth::user()->id;
        $event->post_content = $request->event_description;
        $event->post_type = 'event';
        $event->post_url = $url;
        $event->start_date = $request->event_start_date ?? '';
        $event->end_date = $request->event_end_date ?? '';
        $event->tenant_id = Auth::user()->tenant_id;
        $event->save();
        $event_id = $event->id;
        //send notification
        $user = $event->user;
        $user->notify(new NewPostNotification($event));
        //responsible persons
        if(!empty(json_decode($request->attendees))){
            foreach(json_decode($request->attendees) as $attendee){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new WorkgroupResponsiblePerson;
                $part->post_id = $event_id;
                $part->user_id = $attendee;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
                //send notification
                $user = User::find($attendee);
                $user->notify(new NewPostNotification($event));
            }
        }
        return response()->json(['message'=>'Success!'], 200);
    }

    /*
    * Create announcement
    */
    public function createAnnouncement(Request $request){
        //return dd($this->responsible_persons);
        $this->validate($request, [
            'subject'=>'required',
            'announcement'=>'required'
        ]);
        $url = substr(sha1(time()), 10, 10);
        $announcement = new WorkgroupPost;
        $announcement->post_title = $request->subject;
        $announcement->user_id = Auth::user()->id;
        $announcement->post_content = $request->announcement;
        $announcement->post_type = 'announcement';
        $announcement->post_url = $url;
        $announcement->tenant_id = Auth::user()->tenant_id;
        $announcement->group_id = $request->announcementGroupId;
        $announcement->save();
        $announcement_id = $announcement->id;
        if(!empty($request->announcement_attachment)){
            $filename = Auth::user()->tenant->company_name.'_'.time().date('Y').'.'.$request->announcement_attachment->extension();
            $request->announcement_attachment->storeAs('workgroup', $filename);
            $post_attachment = new WorkgroupAttachment;
            $post_attachment->attachment = $filename;
            $post_attachment->tenant_id = Auth::user()->tenant_id;
            $post_attachment->workgroup_id = $request->announcementGroupId;
            $post_attachment->post_id = $announcement_id;
            $post_attachment->user_id = Auth::user()->id;
            $post_attachment->save();
        }
        //notify
        $user = $announcement->user;
        $user->notify(new WorkgroupNotification($announcement));
        //responsible persons
        if(!empty($request->to)){
            foreach($request->to as $user){
                $res = new WorkgroupResponsiblePerson;
                $res->post_id = $announcement_id;
                $res->user_id = $user;
                $res->group_id = $request->announcementGroupId;
                $res->tenant_id = Auth::user()->tenant_id;
                $res->save();
            }
        }
        return redirect()->back();
    }

    /*
    * Share file within the activity stream
    */
    public function shareFile(Request $request){
        $this->validate($request,[
            'share_file'=>'required',
            'file_name'=>'required'
        ]);
         $url = substr(sha1(time()), 10, 10);
        $file = new WorkgroupPost;
        $file->post_title = $request->file_name;
        $file->user_id = Auth::user()->id;
        $file->post_content = Auth::user()->first_name." shared file in the workgroup";
        $file->post_type = 'file';
        $file->post_url = $url;
        $file->tenant_id = Auth::user()->tenant_id;
        $file->group_id = $request->fileGroupId;
        $file->save();
        $postId = $file->id;

        if(!empty($request->share_file)){
            $extension = $request->file('share_file');
            $extension = $request->file('share_file')->getClientOriginalExtension();
            $filename = Auth::user()->tenant->company_name.'_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $dir = 'assets/uploads/attachments/';
            $request->file('share_file')->move(public_path($dir), $filename);
            //$request->share_file->storeAs('workgroup', $filename);
            $post_attachment = new WorkgroupAttachment;
            $post_attachment->attachment = $filename;
            $post_attachment->tenant_id = Auth::user()->tenant_id;
            $post_attachment->workgroup_id = $request->fileGroupId;
            $post_attachment->post_id = $postId;
            $post_attachment->user_id = Auth::user()->id;
            $post_attachment->save();
        }
        //notify
        $user = $file->user;
        $user->notify(new WorkgroupNotification($file));
        session()->flash("success", "<strong>Success!</strong> File shared.");
        return redirect()->back();
    }

    /*
    * Create appreciation
    */
    public function createAppreciation(Request $request){
        $this->validate($request, [
            'content'=>'required',
            'persons'=>'required'
        ]);

        $url = substr(sha1(time()), 10, 10);
        $app = new WorkgroupPost;
        $app->user_id = Auth::user()->id;
        $app->post_content = $request->content;
        $app->post_type = 'appreciation';
        $app->post_url = $url;
        $app->tenant_id = Auth::user()->tenant_id;
        $app->save();
        $app_id = $app->id;
        //notify
        $user = $app->user;
        $user->notify(new NewPostNotification($app));
        //responsible persons
        if(!empty(json_decode($request->persons))){
            foreach(json_decode($request->persons) as $person){
                $part = new WorkgroupResponsiblePerson;
                $part->post_id = $app_id;
                $part->user_id = $person;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
                 //send notification
                 $user = User::find($person);
                 $user->notify(new NewPostNotification($app));
            }
        }
        return response()->json(['message'=>'Success!'], 200);
    }

    /*
    * Remove member from group
    */
    public function removeMember(Request $request){
        $user = User::where('url', $request->url)->first();
        if(!empty($user) ){
            $id = $user->id;
            $member = WorkgroupMember::where('user_id', $id)->first();
            $member->delete();
        }else{
            return redirect()->route('404');
        }
    }
    /*
    * Remove moderator from group
    */
    public function removeModerator(Request $request){
        $user = User::where('url', $request->url)->first();
        if(!empty($user) ){
            $id = $user->id;
            $moderator = WorkgroupModerator::where('user_id', $id)->first();
            $moderator->delete();
        }else{
            return redirect()->route('404');
        }
    }

    /*
    * Send workgroup invitation
    */
    public function sendWorkgroupInvitation(Request $request){
        $this->validate($request,[
            'employee'=>'required',
            'groupId'=>'required'
        ]);
        $user = User::find($request->employee);
        $workgroup = Workgroup::find($request->groupId);
        $members = WorkgroupMember::where('user_id', $request->employee)
                                    ->where('workgroup_id', $request->groupId)
                                    ->where('tenant_id', Auth::user()->tenant_id)
                                    ->get();
        if(count($members) <= 0){
            $invite = new WorkgroupInvite;
            $invite->workgroup_id = $request->groupId;
            $invite->invite = $request->employee;
            $invite->invited_by = Auth::user()->id;
            $invite->tenant_id = Auth::user()->tenant_id;
            $invite->message = "You're receiving this message because ".Auth::user()->first_name." invited you to join ".$workgroup->group_name." workgroup. Kindly ignore if this was done in error or click the button below to accept invitation to be part of this workgroup. <br/> Thank you.";
            $invite->slug = substr(sha1(time()), 19,40);
            $invite->save();
            $user->notify(new WorkgroupInviteNotification($invite, $workgroup));
            return response()->json(["message"=>"Success! Invitation sent."]);
        }else{
            return response()->json(["message"=>"Ooops! ".$user->first_name." is already a member of this group."]);
        }
    }
    /*
    * View workgroup invite
    */
    public function viewWorkgroupInvite($slug){
        $invite = WorkgroupInvite::where('slug', $slug)->first();
        if(!empty($invite) ){
            return view('backend.workgroup.view-invitation', ['invitation'=>$invite]);
        }else{
            return redirect()->route('404');
        }
    }

    /*
    * Workgroup take action
    */
    public function workgroupAction(Request $request){

        $invite = WorkgroupInvite::where('tenant_id', Auth::user()->tenant_id)
                                ->where('slug', $request->slug)
                                ->where('tenant_id', Auth::user()->tenant_id)
                                ->first();
        if(!empty($invite) ){
            if($request->accept == 1 ){
                if(!empty($invite) ){
                    $invite->status = 1;
                    $invite->save();
                    #add member to the group
                    $member = new WorkgroupMember;
                    $member->workgroup_id = $request->workgroupId;
                    $member->tenant_id = Auth::user()->tenant_id;
                    $member->user_id = Auth::user()->id;
                    $member->request_status = 1; //approved
                    $member->save();
                    session()->flash("success", "<strong>Success!</strong> You now a member of this workgroup.");
                    return redirect()->back();
                }
            }else if($request->decline == 0){

                $invite->status = 2;//declined
                $invite->save();
                $member =  WorkgroupMember::where('tenant_id', Auth::user()->tenant_id)
                                            ->where('user_id', Auth::user()->id)
                                            ->where('workgroup_id', $request->workgroupId)
                                            ->first();
                if(!empty($member) ){
                    $member->delete();
                }
                session()->flash("decline", "<strong>Declined!</strong> You declined the request to be part of this workgroup.");
                return redirect()->back();
            }

        }else{
            session()->flash("decline", "<strong>Ooops!</strong> It's either that invite has expired or does not exist.");
            return redirect()->back();
        }
    }
}
