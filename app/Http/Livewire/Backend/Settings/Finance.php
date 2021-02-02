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
    public $bank_name, $account_name, $account_number, $account_type, $sort_code;
    public function render()
    {
        return view('livewire.backend.settings.finance', ['currencies'=>Currency::all()]);
    }

    public function mount(){
			$this->bank_name = Auth::user()->tenantBankDetails->bank_name ?? '';
			$this->account_name = Auth::user()->tenantBankDetails->account_name ?? '';
			$this->account_number = Auth::user()->tenantBankDetails->account_number ?? '';
			$this->sort_code = Auth::user()->tenantBankDetails->sort_code ?? '';
			$this->account_type = 0;
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
				$tenant = TenantBankDetail::where('tenant_id', Auth::user()->tenant_id)->first();
				if(!empty($tenant)){
					$tenant->bank_name = $this->bank_name;
					$tenant->account_name = $this->account_name;
					$tenant->account_number = $this->account_number;
					$tenant->account_type = $this->account_type;
					$tenant->sort_code = $this->sort_code;
					$tenant->added_by = Auth::user()->id;
					$tenant->tenant_id = Auth::user()->tenant_id;
					$tenant->save();
					session()->flash("bank-success", "<strong>Success!</strong> Bank changes saved.");
				}else{
						$bank = new TenantBankDetail;
						$bank->bank_name = $this->bank_name;
						$bank->account_name = $this->account_name;
						$bank->account_number = $this->account_number;
						$bank->account_type = $this->account_type;
						$bank->sort_code = $this->sort_code;
						$bank->added_by = Auth::user()->id;
						$bank->tenant_id = Auth::user()->tenant_id;
						$bank->save();
						session()->flash("bank-success", "<strong>Success!</strong> Bank details saved.");
				}
    }
}
