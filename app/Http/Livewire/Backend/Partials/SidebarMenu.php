<?php

namespace App\Http\Livewire\Backend\Partials;

use Livewire\Component;
use App\Post;
use App\Message;
use App\ResponsiblePerson;
use Auth;

class SidebarMenu extends Component
{
    public $postIds = [];
    public $responsiblePostIds = [];
    public $unreadMessages = [];
    public function render()
    {
        return view('livewire.backend.partials.sidebar-menu');
    }

    public function mount(){
        $this->getContent();
    }

    public function getContent(){
        $responsiblePersons = ResponsiblePerson::select('post_id')->where('user_id', Auth::user()->id)
                                    ->where('tenant_id', Auth::user()->tenant_id)
                                    ->where('status', 'in-progress')
                                    ->get();
        $unreadMessages = Message::where('tenant_id', Auth::user()->tenant_id)->where('to_id',Auth::user()->id)->where('is_read', 0)->get();
        foreach($unreadMessages as $message){
            array_push($this->unreadMessages, $message->id);
        }
        foreach($responsiblePersons as $per){
            array_push($this->responsiblePostIds, $per->post_id);
        }
        $posts  = Post::select('id')->whereIn('post_type',
                        ['purchase-request', 'expense-request',
                        'leave-request', 'business-trip',
                        'general-request'])
                        ->where('tenant_id',Auth::user()->tenant_id)
                        ->get();
        foreach($posts as $post){
            array_push($this->postIds, $post->id);
        }
    }
}
