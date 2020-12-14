<?php

namespace App\Http\Livewire\Backend\Settings;

use Livewire\Component;
use App\Tenant;
use App\Currency;
use App\TenantBankDetail;
use Auth;
class Finance extends Component
{
    public $invoice_terms, $receipt_terms, $preferred_currency, $currency_position;
    //public $currencies;
    public $bank_name, $account_name, $account_number, $account_type;
    public function render()
    {
        return view('livewire.backend.settings.finance', ['currencies'=>Currency::all()]);
    }

    public function mount(){
    }

    //submit finance
    public function submitFinanceSettings(){
 /*        $this->validate([
            'currency_position'=>'required',
            'preferred_currency'=>'required',
            'invoice_terms'=>'required',
            'receipt_terms'=>'required'
        ]); */
        $tenant = Tenant::where('tenant_id', Auth::user()->tenant->tenant_id)->first();
        $tenant->currency_position_id = $this->currency_position ?? '';
        $tenant->currency_id = $this->preferred_currency ?? 1;
        $tenant->invoice_terms = $this->invoice_terms ?? '';
        $tenant->receipt_terms = $this->receipt_terms ?? '';
        $tenant->save();
        session()->flash("success", "<strong>Success!</strong> Changes saved.");
        return back();
    }

    public function submitBankDetails(){
        $this->validate([
            'account_name'=>'required',
            'account_number'=>'required',
            'bank_name'=>'required',
            'account_type'=>'required'
        ]);
        $bank = new TenantBankDetail;
        $bank->bank_name = $this->bank_name;
        $bank->account_name = $this->account_name;
        $bank->account_number = $this->account_number;
        $bank->account_type = $this->account_type;
        $bank->added_by = Auth::user()->id;
        $bank->tenant_id = Auth::user()->tenant_id;
        $bank->save();
        session()->flash("bank-success", "<strong>Success!</strong> Bank details saved.");
    }
}
