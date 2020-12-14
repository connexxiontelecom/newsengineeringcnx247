<?php

namespace App\Http\Livewire\Backend\Hr;

use Livewire\Component;
use Carbon\Carbon;
use App\LeaveWallet;
use App\User;
use App\Post;
use Auth;

class LeaveManagement extends Component
{
    public $statistics, $thisYear, $lastYear, $lastMonth, $thisMonth;
    public $allTimeApproved, $allTimeDeclined;
    public $leaves, $employees;
    public $onLeave;
    public $employeesOnLeave;

    public function render()
    {
        return view('livewire.backend.hr.leave-management');
    }

    public function mount(){
        $dt = Carbon::now();
        $this->statistics = Post::where('post_type', 'leave-request')->where('tenant_id',Auth::user()->tenant_id)->count();
        $this->thisYear = Post::where('post_type', 'leave-request')->whereYear('created_at', $dt->isCurrentYear())
                        ->where('tenant_id',Auth::user()->tenant_id)->count();
        //$this->lastYear = Post::where('post_type', 'leave-request')->whereYear('created_at', $dt->isLastYear())->count();
        $this->lastMonth = Post::where('post_type', 'leave-request')->whereMonth('created_at', $dt->isLastMonth())
                        ->where('tenant_id',Auth::user()->tenant_id)->count();
        $this->thisMonth = Post::where('post_type', 'leave-request')->whereYear('created_at', $dt->isCurrentMonth())
                        ->where('tenant_id',Auth::user()->tenant_id)->count();
        $this->allTimeApproved = Post::where('post_type', 'leave-request')->where('post_status', 'approved')
                            ->where('tenant_id',Auth::user()->tenant_id)->count();
        $this->allTimeDeclined = Post::where('post_type', 'leave-request')->where('post_status', 'declined')
                            ->where('tenant_id',Auth::user()->tenant_id)->count();
        //current company status
        $this->onLeave = Post::where('post_type', 'leave-request')
                             ->where('post_status', 'approved')
                             ->whereMonth('created_at', $dt->isCurrentMonth())
                             ->where('tenant_id',Auth::user()->tenant_id)
                             ->count();
        $this->employees = User::where('tenant_id',Auth::user()->tenant_id)->count();
        $this->employeesOnLeave = Post::latest()->where('tenant_id',Auth::user()->tenant_id)->take(5)->get();
    }
}
