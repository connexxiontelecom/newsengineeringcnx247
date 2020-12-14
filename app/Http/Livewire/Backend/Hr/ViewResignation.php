<?php

namespace App\Http\Livewire\Backend\Hr;

use Livewire\Component;
use App\Resignation;
use App\EmploymentTerminationLog;
use App\User;
use Auth;
class ViewResignation extends Component
{
    public $slug;
    public $resign;
    public $link;
    public $replies;
    public $query_reply;

    public function render()
    {
        return view('livewire.backend.hr.view-resignation');
    }

    public function mount($url = ''){
        $this->link = request('url', $url);
        $this->getContent();

    }

    public function getContent(){
            $this->resign = Resignation::where('tenant_id', Auth::user()->tenant_id)->where('slug', $this->link)->first();

    }

    public function cancel($id){
        $resign = Resignation::where('tenant_id', Auth::user()->tenant_id)->where('id', $id)->first();
        if(!empty($resign) ){
            $resign->status = 'cancelled';
            $resign->save();
            $this->getContent();
        }
    }
    public function approve($id){
        $resign = Resignation::where('tenant_id', Auth::user()->tenant_id)->where('id', $id)->first();
        if(!empty($resign) ){
            $resign->status = 'approved';
            $resign->save();
            #Terminate employement
            $user = User::where('id', $resign->user_id)->where('tenant_id', Auth::user()->tenant_id)->first();
            $user->account_status = 2; //terminate employment
            $user->save();
            #Register log
            $log = new EmploymentTerminationLog;
            $log->terminated_by = Auth::user()->id;
            $log->tenant_id = Auth::user()->tenant_id;
            $log->effective_date = now();
            $log->user_id = $request->user;
            $log->save();
            $this->getContent();
        }
        return redirect()->route('resignation');
    }
    public function decline($id){
        $resign = Resignation::where('tenant_id', Auth::user()->tenant_id)->where('id', $id)->first();
        if(!empty($resign) ){
            $resign->status = 'declined';
            $resign->save();
            $this->getContent();
        }
    }
}
