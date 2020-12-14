<?php

namespace App\Http\Livewire\Backend\Project;

use Livewire\Component;
use App\Post;
use App\User;
use Auth;

class ProjectBoard extends Component
{   public $projects;
    public function render()
    {
        return view('livewire.backend.project.project-board');
    }

    public function mount(){
        $this->getProjects();
    }

    /*
    * Get all projects
    */
    public function getProjects(){
        $this->projects = Post::where('post_type', 'project')
                                ->where('tenant_id',Auth::user()->tenant_id)
                                ->latest()->get();
    }
}
