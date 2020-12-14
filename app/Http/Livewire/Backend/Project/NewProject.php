<?php

namespace App\Http\Livewire\Backend\Project;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Notifications\NewPostNotification;
use App\Post;
use App\User;
use App\ResponsiblePerson;
use App\Participant;
use App\Observer;
use Auth;

class NewProject extends Component
{
    use WithFileUploads;

    public $project_name, $color, $project_sponsor;
    public $responsible_persons, $project_manager;
    public  $project_description, $due_date, $start_date,
            $participants, $observers, $attachment,
            $priority, $status;
    public $users;

    public function render()
    {
        return view('livewire.backend.project.new-project');
    }

    public function mount(){
        return $this->users = User::select('first_name', 'surname', 'id')
                            ->where('account_status',1)->where('verified', 1)
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->orderBy('first_name', 'ASC')->get();
    }

        /*
    * Create task
    */
    public function createProject(){
        //return dd($this->project_description);
        $this->validate([
            'project_name'=>'required',
            'responsible_persons'=>'required',
            'project_description'=>'required',
            'due_date'=>'required',
            'project_sponsor'=>'required'
        ]);
        /* if(!empty($request->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/';
            $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        } */
        $url = substr(sha1(time()), 10, 10);
        $project = new Post;
        $project->post_title = $this->project_name;
        $project->user_id = Auth::user()->id;
        $project->post_content = $this->project_description;
        //$project->post_color = $this->color;
        $project->project_manager_id = $this->project_manager;
        $project->post_type = 'project';
        $project->post_url = $url;
        $project->start_date = $this->start_date ?? '';
        $project->end_date = $this->due_date;
        $project->post_priority = $this->priority;
        $project->tenant_id = Auth::user()->tenant_id;
        //$task->attachment = $filename;
        $project->save();
        $project_id = $project->id;
        //responsible persons
        if(!empty($this->responsible_persons)){
            foreach($this->responsible_persons as $responsible){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;
                $part->post_id = $project_id;
                $part->user_id = $responsible;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
                //notify this user
                $user = User::find($responsible);
                $user->notify(new NewPostNotification($project));
            }
        }
        //participants
        if(!empty($this->participants)){
            foreach($this->participants as $participant){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant;
                $part->post_id = $project_id;
                $part->user_id = $participant;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        //observers
        if(!empty($this->observers)){
            foreach($this->observers as $observer){

               /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer;
                $part->post_id = $project_id;
                $part->user_id = $observer;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        session()->flash("success", "<strong>Success! </strong> Project created.");
    }
}
