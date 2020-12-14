<?php

namespace App\Http\Livewire\Backend\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Tenant;
use Auth;
use Image;

class Assets extends Component
{
    use WithFileUploads;
    public $company_logo, $favicon;
    public function render()
    {
        return view('livewire.backend.settings.assets');
    }

    public function submitAssetSettings(){
        $this->validate([
            'company_logo' => 'required|image|max:1024', // 1MB Max
            'favicon' => 'required|image|max:1024', // 1MB Max
        ]);
        //company_logo;
        $logo = Image::make($this->company_logo)->encode('jpg');
        //return dd($logo);
         $extension = $this->company_logo->getClientOriginalExtension(); // file extension
        $logo_dir = 'assets/uploads/logos/';
        $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
        $logo->move(public_path($logo_dir), $filename);
        //favicon;
/*         $fextension = $this->favicon->getClientOriginalExtension(); // file extension
        $favicon_dir = 'assets/uploads/favicon/';
        $ffilename = uniqid().'_'.time().'_'.date('Ymd').'.'.$fextension;
        $this->favicon->move(public_path($favicon_dir), $ffilename); */

        //$this->photo->store('photos');
    }
}
