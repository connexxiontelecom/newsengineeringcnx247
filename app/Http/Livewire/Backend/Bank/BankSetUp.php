<?php

namespace App\Http\Livewire\Backend\Bank;

use Livewire\Component;
use App\Bank;
use Auth;
use DB;
class BankSetUp extends Component
{
    public $bank_name, $bank_code;
    public $banks;
    public $edit_mode;
    public $bank_id;
    /**
     * @var mixed
     */
    public $bank_gl_code;
    /**
     * @var mixed
     */
    public $bank_account_number;
    /**
     * @var mixed
     */
    public $bank_branch;

    public function render()
    {


        $tenant_id = Auth::user()->tenant_id;
        $bank_details = DB::table($tenant_id."_coa")->select()->where('bank', '=', '1')->get();
        $data['bank_details'] = $bank_details;
        return view('livewire.backend.bank.bank-set-up', $data);
    }

    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $this->banks = Bank::orderBy('bank_name', 'ASC')->get();
    }

    public function addNewBank(){
        $this->validate([
            'bank_name'=>'required|unique:banks,bank_name',
            'bank_gl_code' =>'required|unique:banks,bank_gl_code',
            'bank_branch'=>'required',
            'bank_account_number' => 'required',

        ]);
        if($this->edit_mode == 1){
            $bank = Bank::find($this->bank_id);

            $bank->bank_gl_code = $this->bank_gl_code;
            $bank->save();

            session()->flash("success", "<strong>Success! </strong> Changes saved.");
            $this->bank_code = '';
            $this->bank_name = '';
            $this->getContent();
            $this->edit_mode = 0;
        }else{
            $bank = new Bank;
            $bank->bank_gl_code = $this->bank_gl_code;
            $bank->bank_account_number = $this->bank_account_number;
            $bank->bank_name = $this->bank_name;
            $bank->bank_branch = $this->bank_branch;
            $bank->tenant_id = Auth::user()->tenant_id;
            $bank->save();
            session()->flash("success", "<strong>Success! </strong> New bank registered.");
            $this->bank_code = '';
            $this->bank_name = '';
            $this->getContent();
        }
    }

    public function editBank($id){
        $this->edit_mode = 1;
        $bank = Bank::find($id);
        $this->bank_name = $bank->bank_name;
        $this->bank_code = $bank->bank_code;
        $this->bank_id = $bank->id;
    }

    public function cancelEdit(){
        $this->bank_name = '';
        $this->bank_code = '';
        $this->edit_mode = 0;

    }

}
