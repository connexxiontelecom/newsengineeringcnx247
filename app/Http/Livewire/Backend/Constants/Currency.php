<?php

namespace App\Http\Livewire\Backend\Constants;

use Livewire\Component;
use App\Currency as CurrencyModel;
use Auth;
class Currency extends Component
{
    public $currency_name, $symbol, $currencies;
    public function render()
    {
        return view('livewire.backend.constants.currency');
    }

    //mount
    public function mount(){
        $this->getContent();
    }

    //submit date format
    public function submitCurrency(){
        $this->validate([
            'currency_name'=>'required',
            'symbol'=>'required'
        ]);
        $curren = new CurrencyModel;
        $curren->name = $this->currency_name;
        $curren->symbol = $this->symbol;
        $curren->save();
        $this->currency_name = '';
        $this->symbol = '';
        session()->flash("success", "<strong>Success!</strong> Currency registered.");
        $this->getContent();
        return redirect()->back();
    }

    public function getContent(){
        $this->currencies = CurrencyModel::orderBy('name', 'ASC')->get();
    }
}
