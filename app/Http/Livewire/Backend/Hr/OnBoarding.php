<?php

namespace App\Http\Livewire\Backend\Hr;

use App\PlanFeature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Mail\onBoardEmployee;
use App\User;
use App\Department;
use App\Tenant;


class OnBoarding extends Component
{
    public $first_name, $surname, $email_address, $mobile_no, $position, $department;
    public $hire_date, $birth_date, $start_date;
    public $plan_feature_d, $count_users, $plan_id;

    public function render()
    {
        $users = DB::table('users')
            ->where('tenant_id', '=', Auth::user()->tenant_id)
            ->get();


        $count_users = $users->count();

        $plan_details = DB::table('plan_features')
            ->where('plan_id', '=', Auth::user()->tenant->plan_id)
            ->first();

        $max_team_size = $plan_details->team_size;

        /* if($count_users >= $max_team_size):
            session()->flash("error", "<strong>Error!</strong> Upgrade Plan to add new user.");
            endif; */

        return view('livewire.backend.hr.on-boarding', ['departments'=>Department::where('tenant_id', Auth::user()->tenant_id)->get()]);
    }

    public function onBoardStaff(){

        $users = DB::table('users')
            ->where('tenant_id', '=', Auth::user()->tenant_id)
            ->get();


        $count_users = $users->count();

        $plan_details = DB::table('plan_features')
            ->where('plan_id', '=', Auth::user()->tenant->plan_id)
            ->first();

        $max_team_size = $plan_details->team_size;

        //if($count_users < $max_team_size):

        $this->validate([
            'first_name'=>'required',
            'surname'=>'required',
            'email_address'=>'required|email|unique:users,email',
            'hire_date'=>'required',
            'birth_date'=>'required',
            'mobile_no'=>'required',
            'position'=>'required'
        ]);
        $password = substr(sha1(time()), 32,40);
        $user = new User;
        $user->first_name = $this->first_name;
        $user->surname = $this->surname;
        $user->email = $this->email_address;
        $user->hire_date = $this->hire_date;
        $user->start_date = $this->start_date;
        $user->birth_date = $this->birth_date;
        $user->mobile = $this->mobile_no;
        $user->position = $this->position;
        $user->tenant_id = Auth::user()->tenant_id;
        $user->password = bcrypt($password);//random password
        $user->verification_link = substr(sha1(time()), 5,15);
        $user->url = substr(sha1(time()), 29,40);

            $user->save();
            \Mail::to($user)->send(new onBoardEmployee($user, $password));
            session()->flash("success", "<strong>Success!</strong> Onboarding process done.");
            return redirect()->back();
        /* else:
            session()->flash("error", "<strong>Error!</strong> Upgrade Plan to add new user.");
            return redirect()->back();
            endif; */
    }
}

