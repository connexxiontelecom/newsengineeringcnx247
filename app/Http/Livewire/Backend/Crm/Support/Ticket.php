<?php

namespace App\Http\Livewire\Backend\Crm\Support;

use Livewire\Component;
use App\User;
use App\Ticket as TicketModel;
use Auth;
class Ticket extends Component
{
    public $subject, $content, $category, $attachment;
    public function render()
    {
        return view('livewire.backend.crm.support.ticket');
    }

    public function submitSupportTicket(){
        $this->validate([
            'category'=>'required',
            'subject'=>'required',
            'content'=>'required'
        ]);
        /*if(!empty($request->file('attachment'))){
                $extension = $request->file('attachment');
                $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
                $dir = 'assets/request-attachments/';
                $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
                $request->file('attachment')->move(public_path($dir), $filename);
            }else{
                $filename = '';
            } */
        //$ticket_no = rand();
        $exist = TicketModel::orderBy('id', 'DESC')->first();
        if(!empty($exist) ){
          $ticket_no = $exist->ticket_no + rand(11, 99);
        }else{
            $ticket_no = rand(111, 999);
        }
        $ticket = new TicketModel;
        $ticket->tenant_id = Auth::user()->tenant_id;
        $ticket->user_id = Auth::user()->id;
        $ticket->message = $this->content;
        $ticket->subject = $this->subject;
        $ticket->category = $this->category;
        $ticket->ticket_no = $ticket_no;
        $ticket->slug = substr(sha1(time()), 21,40);
        $ticket->save();
        session()->flash("success", "<strong>Success!</strong> We've lodged your request with <i>ticket no: <strong>".$ticket_no."</strong></i>. Make reference to this ticket number in your follow-up. Thank you.");
        return redirect()->route('ticket-history');
    }
}
