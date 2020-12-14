<?php

namespace App\Http\Livewire\Backend\User\Settings;

use Livewire\Component;
use App\NextKin as NextOfKin;
use Auth;
class NextKin extends Component
{
    public $full_name, $email, $mobile_no, $relationship, $notify, $address;
    public $btn_text = "Submit";
    public $contacts, $contact, $contact_id;
    public $edit_mode;

    public function render()
    {
        return view('livewire.backend.user.settings.next-kin');
    }

    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $this->contacts = NextOfKin::where('tenant_id', Auth::user()->tenant_id)
                                            ->where('user_id', Auth::user()->id)
                                            ->get();
    }
    public function editContact($id){
        $this->edit_mode = 1;
        $this->contact_id = $id;
        $this->contact = NextOfKin::where('tenant_id', Auth::user()->tenant_id)
                                            ->where('user_id', Auth::user()->id)
                                            ->where('id', $id)
                                            ->first();
        $this->full_name = $this->contact->full_name;
        $this->email = $this->contact['email'];  
        $this->address = $this->contact['address'];
        $this->mobile_no = $this->contact['mobile'];
        $this->relationship = $this->contact['relationship'];
        $this->btn_text = "Save changes";
    }
    public function addContact(){
        $this->validate([
            'full_name'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'mobile_no'=>'required',
            'relationship'=>'required'
        ]);
        if($this->edit_mode == 0){
            $contact = new NextOfKin;
            $contact->full_name = $this->full_name;
            $contact->email = $this->email;
            $contact->address = $this->address;
            $contact->mobile = $this->mobile_no;
            $contact->relationship = $this->relationship;
            $contact->tenant_id = Auth::user()->tenant_id;
            $contact->user_id = Auth::user()->id;
            $contact->save();
            session()->flash("success", "<strong>Success!</strong> New emergency contact registered.");
            $this->edit_mode = 0;
            $this->full_name = '';
            $this->email = ''; 
            $this->address = ''; 
            $this->mobile_no = '';
            $this->relationship = '';
            $this->getContent();
            return back();
        }else{
            $contact = NextOfKin::where('tenant_id', Auth::user()->tenant_id)
                                        ->where('user_id', Auth::user()->id)
                                        ->where('id', $this->contact_id)
                                        ->first();
            $contact->full_name = $this->full_name;
            $contact->email = $this->email;
            $contact->address = $this->address;
            $contact->mobile = $this->mobile_no;
            $contact->relationship = $this->relationship;
            $contact->tenant_id = Auth::user()->tenant_id;
            $contact->user_id = Auth::user()->id;
            $contact->save();
            session()->flash("success", "<strong>Success!</strong> Changes saved.");
            $this->edit_mode = 0;
            $this->full_name = '';
            $this->email = ''; 
            $this->address = ''; 
            $this->mobile_no = '';
            $this->relationship = '';
            $this->getContent();
            return back();
        }
    }

    public function cancelEdit(){
        $this->edit_mode = 0;
        $this->full_name = '';
        $this->email = ''; 
        $this->address = ''; 
        $this->mobile_no = '';
        $this->relationship = '';
        $this->btn_text = "Submit";
    }
}
