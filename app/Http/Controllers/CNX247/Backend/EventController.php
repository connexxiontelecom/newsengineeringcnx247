<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use App\Notifications\NewPostNotification;
use Illuminate\Http\Request;
use App\User;
use App\ResponsiblePerson;
use App\Post;
use Auth;
use DateTime;
class EventController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function myEvents(){
        return view('backend.events.my-events');
    }

    public function addNewEvent(){
        $users = User::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.events.new-event', ['users'=>$users]);
    }

    /*
    * store event
    */
    public function storeEvent(Request $request){
        $this->validate($request,[
            'event_name'=>'required',
            'event_description'=>'required',
            'event_date'=>'required|date',
            'audience'=>'required',
            'event_end_date'=>'required|date|after_or_equal:event_date'
        ]);
        $url = substr(sha1(time()), 10, 10);
        $event = new Post;
        $event->post_title = $request->event_name;
        $event->user_id = Auth::user()->id;
        $event->post_content = $request->event_description;
        $event->post_type = 'event';
        $event->post_url = $url;
        $event->post_color = $request->color;
				$event->tenant_id = Auth::user()->tenant_id;

				$startDateInstance = new DateTime($request->event_date);
				$event->start_date = $startDateInstance->format('Y-m-d H:i:s');

					$dueDateInstance = new DateTime($request->event_end_date);
				$event->end_date = $dueDateInstance->format('Y-m-d H:i:s');

        $event->save();
        $event_id = $event->id;
        //send notification
        $user = $event->user;
        $user->notify(new NewPostNotification($event));
        //responsible persons
        if($request->audience == 0){
            $users = User::where('tenant_id', Auth::user()->tenant_id)->where('id', '!=', Auth::user()->id)->get();
            $part = new ResponsiblePerson;
            $part->post_id = $event_id;
            $part->post_type = 'event';
            $part->user_id = 32;//all employee
            $part->save();
            foreach($users as $use){
                //send notification
                $user = User::find($use->id);
                $user->notify(new NewPostNotification($event));
            }
        }else{
            if(!empty($request->attendees)){
                foreach($request->attendees as $attendee){
                    $part = new ResponsiblePerson;
                    $part->post_id = $event_id;
                    $part->post_type = 'event';
                    $part->user_id = $attendee;
                    $part->save();
                    //send notification
                    $user = User::find($attendee);
                    $user->notify(new NewPostNotification($event));
                }
            }
        }
        session()->flash("success", "<strong>Success!</strong> Personal event saved.");
        return redirect()->route('my-event-list');
    }

    public function myEventList(){
        $events = Post::where('post_type', 'event')
                        ->where('tenant_id', Auth::user()->tenant_id)
												->where('user_id', Auth::user()->id)
												->orderBy('id', 'DESC')
                        ->get();
        return view('backend.events.event-list', ['events'=>$events]);
    }


    /*
    * my event calendar
    */
    public function eventCalendar(){
        return view('backend.events.event-calendar');
    }

    /*
    * my event calendar data
    */
    public function getEventCalendarData(){
        $event = Post::select('post_title as title', 'start_date as start', 'end_date as end', 'post_color as color')
                    ->where('post_type', 'event')
                    ->where('tenant_id', Auth::user()->tenant_id)
                    ->where('user_id', Auth::user()->id)
                    ->get();
        return response($event);
    }
    /*
    * company event calendar
    */
    public function companyCalendar(){
        return view('backend.events.company-calendar');
    }

    /*
    * company event calendar data
    */
    public function getCompanyEventData(){
        $event = Post::select('post_title as title', 'start_date as start', 'end_date as end', 'post_color as color')
                    ->where('post_type', 'event')
                    ->where('tenant_id', Auth::user()->tenant_id)
                    ->where('user_id', Auth::user()->id)
                    ->get();
        return response($event);
    }
}
