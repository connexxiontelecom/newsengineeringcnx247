<?php

namespace App\Http\Livewire\Backend\Hr;

use Livewire\Component;
use App\User;
use Auth;

class QueryEmployee extends Component
{
    public $employees;
    public $employee, $subject, $query_type = 0, $query_content;
    public $link;
    public function render()
    {
        return view('livewire.backend.hr.query-employee');
    }

    public function mount($url = ''){
        $this->link = request('url', $url);
        $this->getContent();
    }

    public function getContent(){
        $this->employee = User::where('url', $this->link)->where('tenant_id', Auth::user()->tenant_id)->first();
    }

    public function queryEmployee(){
        return dd($this->query_content);
        $this->validate([
            'subject'=>'required',
            'query_type'=>'required',
            'query_content'=>'required'
        ]);
    }
}
