<?php

namespace App\Http\Livewire\Backend\Crm\Clients;

use Livewire\Component;
use App\Client;
use App\Country;
use Auth;

class Create extends Component
{
    public $title, $first_name, $surname, $suffix, $mobile_no, $email, $website, $street_1, $street_2;
    public $country, $state, $city, $postal_code, $note;
    public $company_name, $position;

    public function render()
    {
        return view('livewire.backend.crm.clients.create', ['countries'=>Country::orderBy('name', 'ASC')->get()]);
    }

    public function addNewClient(){
        $messages = [
            'required' => 'The :attribute is mandatory',
            'mobile_no.regex' => 'The phone number must be in E.164 format(+234...)'
        ];
         $this->validate([
            'first_name'=>'required',
            'surname'=>'required',
            'mobile_no'=>'required|regex:/^\+[1-9]\d{1,14}$/',
            'street_1'=>'required',
            'email'=>'required|email',
            'country'=>'required',
            'company_name'=>'required',
            'city'=>'required'
         ], $messages);
        $client = new Client;
        $client->owner = Auth::user()->id;
        $client->assigned_to = Auth::user()->id;
        $client->company_name = $this->company_name;
        $client->first_name = $this->first_name;
        $client->surname = $this->surname;
        $client->mobile_no = $this->mobile_no;
        $client->position = $this->position ?? '';
        $client->website = $this->website ?? '';
        $client->street_1 = $this->street_1;
        $client->street_2 = $this->street_2 ?? '';
        $client->email = $this->email;
        $client->country_id = $this->country;
        $client->state_id = $this->state;
        $client->city = $this->city;
        $client->postal_code = $this->postal_code;
        $client->note = $this->note ?? '';
        $client->tenant_id = Auth::user()->tenant_id ?? 0;
        $client->slug = substr(sha1(time()), 13,40);
        $client->save();
        session()->flash("success", "<strong>Success!</strong> New client registered.");
        return redirect()->route('clients');
    }
}
