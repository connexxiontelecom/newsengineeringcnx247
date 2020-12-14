<?php

namespace App\Http\Livewire\Backend\Hr;

use Livewire\Component;
use Carbon\Carbon;
use App\User;
use App\Post;
use Auth;

class Appreciation extends Component
{
    public $users = [];
    public $appreciations = [];
    public $lastMonth, $thisYear, $thisMonth, $lastYear;

    public function render()
    {
        return view('livewire.backend.hr.appreciation');
    }

    public function mount(){
        $dt = Carbon::now();
        $this->users = User::orderBy('first_name', 'ASC')->where('tenant_id',Auth::user()->tenant_id)->get();
        $this->appreciations = Post::where('post_type', 'appreciation')
                                ->where('tenant_id',Auth::user()->tenant_id)->get();
        $this->thisYear = Post::where('post_type', 'appreciation')->whereYear('created_at', $dt->isCurrentYear())
                                ->where('tenant_id',Auth::user()->tenant_id)->count();
        $this->lastYear = Post::where('post_type', 'appreciation')->whereYear('created_at', $dt->isLastYear())
                                ->where('tenant_id',Auth::user()->tenant_id)->count();
        $this->lastMonth = Post::where('post_type', 'appreciation')->whereMonth('created_at', $dt->isLastMonth())
                                ->where('tenant_id',Auth::user()->tenant_id)->count();
        $this->thisMonth = Post::where('post_type', 'appreciation')->whereYear('created_at', $dt->isCurrentMonth())
                                ->where('tenant_id',Auth::user()->tenant_id)->count();
    }
}
