<?php

namespace App\Http\Livewire\Backend\Hr;

use Livewire\Component;
use App\User;
use App\Resignation as ResignationModel;
use Carbon\Carbon;
use Auth;

class Resignation extends Component
{   public $approved, $declined, $inProgress;
    public $resignations;
    public $thisMonth, $thisWeek, $thisYear,$lastMonth;

    public function render()
    {
        return view('livewire.backend.hr.resignation');
    }

    public function mount(){
        $now = Carbon::now();
        $this->resignations = ResignationModel::where('tenant_id',Auth::user()->tenant_id)->get();

        $this->thisYear = ResignationModel::where('tenant_id', Auth::user()->tenant_id)
                                ->whereYear('effective_date', date('Y'))
                                ->count();
        $this->thisMonth = ResignationModel::where('tenant_id', Auth::user()->tenant_id)
                                ->whereMonth('effective_date', date('m'))
                                ->whereYear('effective_date', date('Y'))
                                ->count();
        $this->lastMonth = ResignationModel::where('tenant_id', Auth::user()->tenant_id)
                            ->whereMonth('effective_date', '=', $now->subMonth()->month)
                            ->count();
        $this->thisWeek = ResignationModel::where('tenant_id', Auth::user()->tenant_id)
                                ->whereBetween('effective_date', [$now->startOfWeek()->format('Y-m-d H:i'), $now->endOfWeek()->format('Y-m-d H:i')])
                                ->count();
    }
}
