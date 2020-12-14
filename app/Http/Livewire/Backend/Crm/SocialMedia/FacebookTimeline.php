<?php

namespace App\Http\Livewire\Backend\Crm\SocialMedia;

use Livewire\Component;
use App\FacebookPage;
use Auth;
class FacebookTimeline extends Component
{
    public $page, $group, $message, $section;
    public $messages, $pages, $groups;
    public function render()
    {
        return view('livewire.backend.crm.social-media.facebook-timeline');
    }

    public function mount(){
        $this->section = null;
    }
    /*
    * post to Facebook
    */
    public function postToFacebook(){
        $this->validate([
            'message'=>'required',
            'section'=>'required'
        ]);

    }
}
