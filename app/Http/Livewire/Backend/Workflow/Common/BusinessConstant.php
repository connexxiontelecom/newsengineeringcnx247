<?php

namespace App\Http\Livewire\Backend\Workflow\Common;

use Livewire\Component;
use App\User;
use App\Department;
use App\RequestApprover;
use Auth;
class BusinessConstant extends Component
{
    public $users;
    public $processor_list;
    public $departments;
    public $department, $processors, $request_type;
    public function render()
    {
        return view('livewire.backend.workflow.common.business-constant');
    }

    /*
    * list of users
    */
    public function mount(){
        $this->initializeValues();
    }

    public function initializeValues(){
        $this->users = User::select('first_name', 'surname', 'id')
        ->where('account_status',1)->where('verified', 1)
        ->where('tenant_id',Auth::user()->tenant_id)
        ->orderBy('first_name', 'ASC')->get();
        $this->departments = Department::orderBy('department_name', 'ASC')->where('tenant_id',Auth::user()->tenant_id)->get();
        $this->processor_list = RequestApprover::where('tenant_id',Auth::user()->tenant_id)->get();
    }

    /*
    * Set approvers
    */
    public function setBusinessConstant(){
        if(!empty($this->processors) ){
            foreach($this->processors as $processor){
                $p = new RequestApprover;
                $p->user_id =  $processor;
                $p->request_type =  $this->request_type;
                $p->depart_id =  $this->department;
                $p->set_by =  Auth::user()->id;
                $p->approver_stage =  'undefined';
                $p->tenant_id =  Auth::user()->tenant_id;
                $p->save();
            }
            session()->flash("success", " <strong>Success!</strong> Business process parameters set");
            $this->initializeValues();
            return;
        }else{
            session()->flash("error", " <strong>Ooops!</strong> Please provide at least one request processor.");
            return;
        }
    }
}
