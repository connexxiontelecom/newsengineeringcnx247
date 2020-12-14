<?php

namespace App\Http\Livewire\Backend\Project;

use Livewire\Component;
use Carbon\Carbon;
use App\Post;
use App\User;
use Auth;

class ProjectAnalytics extends Component
{
    public $overall, $thisYear, $thisMonth, $thisWeek;
    public $lastYear, $lastThreeYears, $lastMonth, $lastWeek, $yesterday, $today;
    public $projects;
    public $from, $to;
    public function render()
    {
        return view('livewire.backend.project.project-analytics');
    }

    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $now = Carbon::now();
        $this->overall = Post::where('tenant_id', Auth::user()->tenant_id)
                        ->where('post_type', 'project')
                        ->count();
        $this->thisYear = Post::where('tenant_id', Auth::user()->tenant_id)
                        ->where('post_type', 'project')
                        ->whereYear('created_at', date('Y'))
                        ->count();
        $this->thisMonth = Post::where('tenant_id', Auth::user()->tenant_id)
                        ->where('post_type', 'project')
                        ->whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))
                        ->count();
        $this->thisWeek = Post::where('tenant_id', Auth::user()->tenant_id)
                        ->where('post_type', 'project')
                        ->whereBetween('created_at', [$now->startOfWeek()->format('Y-m-d H:i'), $now->endOfWeek()->format('Y-m-d H:i')])
                        ->count();
        $this->lastYear = Post::where('tenant_id', Auth::user()->tenant_id)
                        ->where('post_type', 'project')
                        ->whereYear('created_at', date('Y', strtotime('-1 year')))
                        ->count();
        $this->lastThreeYears = Post::where('tenant_id', Auth::user()->tenant_id)
                        ->where('post_type', 'project')
                        ->whereYear('created_at', date('Y', strtotime('-3 year')))
                        ->count();

        $this->lastMonth = Post::where('tenant_id', Auth::user()->tenant_id)
                        ->where('post_type', 'project')
                        ->whereMonth('created_at', '=', $now->subMonth()->month)
                        ->count();
        #Par
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);

        $this->lastWeek = Post::where('tenant_id', Auth::user()->tenant_id)
                        ->where('post_type', 'project')
                        ->whereBetween('created_at', [$start_week, $end_week])
                        ->count();
        $this->yesterday = Post::where('tenant_id', Auth::user()->tenant_id)
                        ->where('post_type', 'project')
                        ->whereDay('created_at', $now->yesterday())
                        ->count();
        $this->today = Post::where('tenant_id', Auth::user()->tenant_id)
                        ->where('post_type', 'project')
                        ->whereDay('created_at', $now->today())
                        ->count();

        #List of projects
        $this->projects = Post::where('tenant_id', Auth::user()->tenant_id)
                            ->where('post_type', 'project')
                            ->get();
    }

    public function sortProject(){
        $this->validate([
            'from'=>'required',
            'to'=>'required'
        ]);
        #List of projects
        $this->projects = Post::where('tenant_id', Auth::user()->tenant_id)
                            ->where('post_type', 'project')
                            ->whereBetween('created_at', [$this->from, $this->to])
                            ->get();
    }
}
