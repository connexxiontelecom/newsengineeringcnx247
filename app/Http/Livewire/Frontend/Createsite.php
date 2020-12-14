<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Paystack;
use App\Plan;
use App\PlanFeature;

class Createsite extends Component
{
    public $timestamp, $plan, $terms, $site_address;
    public $password, $email, $company_name, $role;
    public $industry, $use_case, $team_size, $phone;
    public $chosen_plan, $features;

    public function render()
    {
        return view('livewire.frontend.createsite');
    }

    public function mount($timestamp = '', $plan = ''){
        $this->timestamp = request('timestamp', $timestamp);
        $this->plan = request('plan', $plan);
        $this->createSite();
    }

    /*
    * Custom create site method
    */
    public function createSite(){
        $this->chosen_plan = Plan::where('slug', $this->plan)->first();
        $this->features = PlanFeature::where('plan_id', $this->chosen_plan->id)->get();
    }

    /*
    * Process createSite request
    */
    public function processCreateSite(){
        $this->validate([
            'site_address'=>'required',
            'company_name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'industry'=>'required',
            'use_case'=>'required',
            'phone'=>'required',
            'team_size'=>'required',
            'terms'=>'required',
            'role'=>'required'
        ]);

        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }
}
