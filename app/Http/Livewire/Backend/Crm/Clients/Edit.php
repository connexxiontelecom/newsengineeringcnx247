<?php

namespace App\Http\Livewire\Backend\Crm\Clients;

use Livewire\Component;
use App\Client;
use App\Country;
use Auth;
class Edit extends Component
{
    public $title, $first_name, $surname, $suffix, $mobile_no, $email, $website, $street_1, $street_2;
    public $country, $state, $city, $postal_code, $note;
    public $link;
    public $client_id;

    public function render()
    {
        return view('livewire.backend.crm.clients.edit',['countries'=>Country::orderBy('name', 'ASC')->get()]);
    }
    public function mount($slug = ''){
        $this->link = request('slug', $slug);
        $this->getContent();
    }

    public function getContent(){
        $this->client = Client::where('slug', $this->link)->where('tenant_id', Auth::user()->tenant_id)->first();
        $this->client_id = $this->client->id;
        $this->title = $this->client->title;
        $this->first_name = $this->client->first_name;
        $this->surname = $this->client->surname;
        $this->suffix = $this->client->suffix;
        $this->mobile_no = $this->client->mobile_no;
        $this->email = $this->client->email;
        $this->website = $this->client->website;
        $this->street_1 = $this->client->street_1;
        $this->street_2 = $this->client->street_2;
        $this->city = $this->client->city;
        $this->country = $this->client->country;
        $this->postal_code = $this->client->postal_code;
        $this->note = $this->client->note;
    }

    public function saveClientChanges(){
        $this->validate([
            'title'=>'required',
            'first_name'=>'required',
            'surname'=>'required',
            'mobile_no'=>'required',
            'street_1'=>'required',
            'email'=>'required|email',
            'country'=>'required',
            'city'=>'required'
        ]);
        $client =  Client::where('id', $this->client_id)->where('tenant_id', Auth::user()->tenant_id)->first();
        $client->owner = Auth::user()->id;
        $client->assigned_to = Auth::user()->id;
        $client->title = $this->title;
        $client->first_name = $this->first_name;
        $client->surname = $this->surname;
        $client->mobile_no = $this->mobile_no;
        $client->suffix = $this->suffix ?? '';
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
        session()->flash("success", "<strong>Success!</strong> Changes saved.");
        return redirect()->route('clients');
    }
}
