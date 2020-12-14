<?php

namespace App\Http\Livewire\Backend\User;

use Livewire\Component;
use App\User;
use App\Notification;
use Auth;
use DB;
class Notifications extends Component
{
    public $notifications = [];
    public $read, $unread;
    public function render()
    {
        return view('livewire.backend.user.notifications');
    }

    public function mount(){
        if(Auth::check()){
            $this->read = Auth::user()->readNotifications;
            $this->unread = Auth::user()->unReadNotifications;
        }
    }

    /*
    * Mark as read
    */
     public function markNotificationAsRead(){
           Auth::user()->unreadNotifications()->update(['read_at' => now()]);
    }

    public function markAllAsRead(){
        foreach (Auth::user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return back();
    }
}
