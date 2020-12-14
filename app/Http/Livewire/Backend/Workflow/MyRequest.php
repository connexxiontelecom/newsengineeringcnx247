<?php

namespace App\Http\Livewire\Backend\Workflow;

use Livewire\Component;
use App\Post;
use Auth;
use Livewire\WithPagination;

class MyRequest extends Component
{
    use WithPagination;
		public $my_requests;
		public $current_action;
		public $loaderStatus = 0;
    public function render()
    {
        return view('livewire.backend.workflow.my-request');
    }

    public function mount(){
        $this->getMyRequests();
    }

    /*
    * Get all my requests
    */
    public function getMyRequests(){
        $this->my_requests = Post::where('user_id', Auth::user()->id)
                                    ->whereIn('post_type',
                                    ['purchase-request', 'expense-request',
                                    'leave-request', 'business-trip',
                                    'general-request'])
                                    ->where('tenant_id',Auth::user()->tenant_id)
                                    ->orderBy('id', 'DESC')
                                    ->get();
    }


    public function allWorkflows(){
			$this->current_action = 'All';
			$this->loaderStatus = 1;
			$this->getMyRequests();
			$this->loaderStatus = 0;
    }
    public function inprogressWorkflows(){
			$this->loaderStatus = 1;
			$this->current_action = 'In-progress';
        $this->my_requests = Post::whereIn('post_type',
                          ['purchase-request', 'expense-report',
                          'leave-request', 'business-trip',
                          'general-request'])
                          ->where('post_status', 'in-progress')
                          ->where('user_id', Auth::user()->id)
                          ->where('tenant_id',Auth::user()->tenant_id)
                          ->orderBy('id', 'DESC')
													->get();
													$this->loaderStatus = 0;
    }
    public function approvedWorkflows(){
			$this->loaderStatus = 1;
			$this->current_action = 'Approved';
        $this->my_requests = Post::whereIn('post_type',
                          ['purchase-request', 'expense-report',
                          'leave-request', 'business-trip',
                          'general-request'])
                          ->where('post_status', 'approved')
                          ->where('user_id', Auth::user()->id)
                          ->where('tenant_id',Auth::user()->tenant_id)
                          ->orderBy('id', 'DESC')
													->get();
													$this->loaderStatus = 0;
    }
    public function declinedWorkflows(){
			$this->loaderStatus = 1;
			$this->current_action = 'Declined';
        $this->my_requests = Post::whereIn('post_type',
                          ['purchase-request', 'expense-report',
                          'leave-request', 'business-trip',
                          'general-request'])
                          ->where('post_status', 'declined')
                          ->where('user_id', Auth::user()->id)
                          ->where('tenant_id',Auth::user()->tenant_id)
                          ->orderBy('id', 'DESC')
													->get();
													$this->loaderStatus = 0;
    }
}
