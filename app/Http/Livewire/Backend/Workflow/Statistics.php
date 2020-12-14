<?php

namespace App\Http\Livewire\Backend\Workflow;

use Livewire\Component;
use App\Post;
use Carbon\Carbon;
use Auth;

class Statistics extends Component
{
    public $overall, $thisYear, $lastMonth, $thisMonth;

    public function render()
    {
        return view('livewire.backend.workflow.statistics');
    }

    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $now = Carbon::now();
        $this->overall = Post::whereIn('post_type',
                            ['purchase-request', 'expense-report',
                            'leave-request', 'business-trip',
                            'general-request'])
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->where('post_status', 'approved')
                            ->sum('budget');
        $this->thisYear = Post::whereIn('post_type',
                            ['purchase-request', 'expense-report',
                            'leave-request', 'business-trip',
                            'general-request'])
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->where('post_status', 'approved')
                            ->whereYear('created_at', date('Y'))
                            ->sum('budget');
        $this->thisMonth = Post::whereIn('post_type',
                            ['purchase-request', 'expense-report',
                            'leave-request', 'business-trip',
                            'general-request'])
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->where('post_status', 'approved')
                            ->whereMonth('created_at', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->sum('budget');
        $this->lastMonth = Post::whereIn('post_type',
                            ['purchase-request', 'expense-report',
                            'leave-request', 'business-trip',
                            'general-request'])
                            ->where('tenant_id',Auth::user()->tenant_id)
                            ->where('post_status', 'approved')
                            ->whereMonth('created_at', '=', $now->subMonth()->month)
                            ->sum('budget');

    }
}
