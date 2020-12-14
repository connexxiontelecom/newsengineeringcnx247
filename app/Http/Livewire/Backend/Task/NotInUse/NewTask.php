<?php

namespace App\Http\Livewire\Backend\Task;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Post;
use App\User;
use App\Status;
use App\Priority;
use App\ResponsiblePerson;
use App\Participant;
use App\Observer;
use Auth;

class NewTask extends Component
{
    use WithFileUploads;
    public $task_title, $color;
    public $responsible_persons = [];
    public  $task_description, $due_date, $start_date,
            $participants = [], $observers = [], $attachment,
            $priority, $status;
    public $priorities, $statuses;
    public $users;

    public function render()
    {
        return view('livewire.backend.task.new-task');
    }

    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $this->users = User::select('first_name', 'surname', 'id')
                            ->where('account_status',1)->where('verified', 1)
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->orderBy('first_name', 'ASC')->get();
        $this->priorities = Priority::all();
        $this->statuses = Status::all();
    }

    /*
    * Create task
    */
    public function createTask(){
        //return dd($this->responsible_persons);
        //return dd($this->attachment);
         $this->validate([
            'task_title'=>'required',
            'responsible_persons'=>'required',
            'task_description'=>'required',
            'due_date'=>'required'
        ]);

        $url = substr(sha1(time()), 10, 10);
        $task = new Post;
        $task->post_title = $this->task_title;
        $task->user_id = Auth::user()->id;
        $task->post_content = $this->task_description;
        $task->post_color = $this->color;
        $task->post_type = 'task';
        $task->post_url = $url;
        $task->start_date = $this->start_date ?? '';
        $task->end_date = $this->due_date;
        $task->post_priority = $this->priority;
        $task->tenant_id = Auth::user()->tenant_id;
        //$task->attachment = $filename;
        $task->save();
        $task_id = $task->id;
        if(!empty($this->attachment)){
            $filename = Auth::user()->tenant->company_name.'_'.time().date('Y').'.'.$this->attachment->extension();
            $this->attachment->storeAs('task', $filename);
            $post_attachment = new PostAttachment;
            $post_attachment->attachment = $filename;
            $post_attachment->tenant_id = Auth::user()->tenant_id;
            $post_attachment->post_id = $task_id;
            $post_attachment->save();
        }
        //responsible persons
        if(!empty($this->responsible_persons)){
            foreach($this->responsible_persons as $participant){
               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;
                $part->post_id = $task_id;
                $part->user_id = $participant;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        //participants
        if(!empty($this->participants)){
            foreach($this->participants as $person){
               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant;
                $part->post_id = $task_id;
                $part->user_id = $person;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        //observers
        if(!empty($this->observers)){
            foreach($this->observers as $observe){
               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer;
                $part->post_id = $task_id;
                $part->user_id = $observe;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }

        return redirect()->route('task-board');
    }


/*
    public function store(Request $request)
    {
        $this->validate($request,[
            'task_name'=>'required|string',
            'due_date'=>'required',
            'responsible_persons'=>'required'
        ]);
        if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/';
            $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }
        $url = substr(sha1(time()), 10, 10);
        $task = new Post;
        $task->post_title = $request->task_name;
        $task->post_author = Auth::user()->id;
        $task->post_content = $request->description;
        $task->post_color = $request->color;
        $task->post_type = 'task';
        $task->post_url = $url;
        //$task->post_start_date = $request->start_date;
        $task->post_due_date = $request->due_date;
        $task->post_priority = $request->priority;
        $task->attachment = $filename;
        $task->save();
        $task_id = $task->id;
        //save responsible persons
        if(!empty(json_decode($request->responsible_persons))){
            foreach(json_decode($request->responsible_persons) as $participant){

                $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url));
                $part = new ResponsiblePerson;
                $part->post_id = $task_id;
                $part->user_id = $participant;
                $part->save();
            }
        }

        //save participants
        if(!empty(json_decode($request->participants))){
            foreach(json_decode($request->participants) as $person){
                $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $person)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url));

                $part = new Participant;
                $part->post_id = $task_id;
                $part->participant_id = $person;
                $part->save();
            }
        }

        //save observers
        if(!empty(json_decode($request->observers))){
            foreach(json_decode($request->observers) as $observer){
                $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $observer)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url));

                $part = new Observer;
                $part->post_id = $task_id;
                $part->observer_id = $observer;
                $part->save();
            }
        }

        return response()->json(['message'=>'Success! Task registered.']);

    } */
}
