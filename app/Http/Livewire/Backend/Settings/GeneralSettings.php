<?php

namespace App\Http\Livewire\Backend\Settings;

use Livewire\Component;
use App\DefaultDateFormat;
use App\Industry;
use App\Tenant;
use Auth;

class GeneralSettings extends Component
{
    public $company_name, $email_signature, $tagline, $about_use, $city, $street_1, $street_2, $postal_code;
    public $industry, $preferred_lang, $date_format, $company_prefix, $phone;
    public $opening_time, $closing_time, $grace_period, $timezone;
    public function render()
    {
        return view('livewire.backend.settings.general-settings',
        [
        'date_formats'=>DefaultDateFormat::all(),
        'industries'=>Industry::orderBy('industry', 'ASC')->get()
        ]);
    }

    public function mount(){
        $this->company_name = Auth::user()->tenant->company_name;
        $this->email_signature = Auth::user()->tenant->email_signature;
        $this->tagline = Auth::user()->tenant->tagline;
        $this->city = Auth::user()->tenant->city;
        $this->street_1 = Auth::user()->tenant->street_1;
        $this->street_2 = Auth::user()->tenant->street_2;
        $this->postal_code = Auth::user()->tenant->postal_code;
        $this->industry = Auth::user()->tenant->industry_id;
        $this->preferred_lang = Auth::user()->tenant->lang_id;
        $this->date_format = Auth::user()->tenant->date_format_id;
        $this->company_prefix = Auth::user()->tenant->company_prefix;
        $this->phone = Auth::user()->tenant->phone;
        $this->opening_time = Auth::user()->tenant->opening_time;
        $this->closing_time = Auth::user()->tenant->closing_time;
        $this->grace_period = Auth::user()->tenant->grace_period;
    }

    /*
    * Save general settings
    */
    public function saveGeneralSettings(){
        $this->validate([
            'company_name'=>'required',
            'email_signature'=>'required',
            'tagline'=>'required',
            //'about_use'=>'required',
            'city'=>'required',
            'street_1'=>'required',
            'postal_code'=>'required',
            'industry'=>'required',
            'preferred_lang'=>'required',
            'date_format'=>'required',
            'company_prefix'=>'required',
            'phone'=>'required',
        ]);
        $tenant = Tenant::where('tenant_id', Auth::user()->tenant->tenant_id)->first();
        $tenant->company_name = $this->company_name ?? '';
        $tenant->email_signature = $this->email_signature ?? '';
        $tenant->tagline = $this->tagline ?? '';
        $tenant->description = $this->about_use ?? '';
        $tenant->city = $this->city ?? '';
        $tenant->street_1 = $this->street_1 ?? '';
        $tenant->street_2 = $this->street_2 ?? '';
        $tenant->postal_code = $this->postal_code ?? '';
        $tenant->industry_id = $this->industry ?? '';
        $tenant->lang_id = $this->preferred_lang ?? '';
        $tenant->date_format_id = $this->date_format ?? '';
        $tenant->company_prefix = $this->company_prefix ?? '';
        $tenant->phone = $this->phone ?? '';
        $tenant->closing_time = $this->closing_time ?? '';
        $tenant->opening_time = $this->opening_time ?? '';
        $tenant->grace_period = $this->grace_period ?? '';
        $tenant->save();
        session()->flash("success", "<strong>Success!</strong> Changes updated.");
        return back();
    }
}
