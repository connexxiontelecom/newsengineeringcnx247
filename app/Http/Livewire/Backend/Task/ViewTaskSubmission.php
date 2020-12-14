<?php

namespace App\Http\Livewire\Backend\Task;

use Livewire\Component;
use App\PostSubmission;
use Auth;
class ViewTaskSubmission extends Component
{
    public function render()
    {
        return view('livewire.backend.task.view-task-submission',
        ['submissions' => PostSubmission::orderBy('id', 'DESC')->get()
        ]);
    }
}
