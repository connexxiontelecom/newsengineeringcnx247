<?php

namespace App\Http\Livewire\Backend\Task;

use Livewire\Component;
use App\Post;
use App\User;
use Auth;

class TaskBoard extends Component
{
    public $tasks;
    public $completedTasks, $atRiskTasks, $inprogressTasks, $cancelTask;

    public function render()
    {
        return view('livewire.backend.task.task-board');
    }

    public function mount(){
        $this->getTasks();
    }

    /*
    * Get all tasks
    */
    public function getTasks(){
        $this->tasks = Post::where('post_type', 'task')->where('tenant_id',Auth::user()->tenant_id)->latest()->get();
        $this->completedTasks = Post::where('post_type', 'task')
                                ->where('tenant_id',Auth::user()->tenant_id)
                                ->where('post_status', 'complete')
                                ->count();
        $this->inprogressTasks = Post::where('post_type', 'task')
                                ->where('tenant_id',Auth::user()->tenant_id)
                                ->where('post_status', 'in-progress')
                                ->count();
        $this->atRiskTasks = Post::where('post_type', 'task')
                                ->where('tenant_id',Auth::user()->tenant_id)
                                ->where('post_status', 'at-risk')
                                ->count();
        $this->cancelTask = Post::where('post_type', 'task')
                                ->where('tenant_id',Auth::user()->tenant_id)
                                ->where('post_status', 'cancel')
                                ->count();
    }
}
