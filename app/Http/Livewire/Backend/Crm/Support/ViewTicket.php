<?php

namespace App\Http\Livewire\Backend\Crm\Support;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Ticket;
use App\TicketConversation;
use Auth;

class ViewTicket extends Component
{
    use WithFileUploads;

    public $link;
    public $ticket;
    public $message, $attachment;
    public $ticket_id, $tenant_id, $user_id;
    public $messages;

    public function render()
    {
        return view('livewire.backend.crm.support.view-ticket');
    }

    public function mount($slug = ''){
        $this->link = request('slug', $slug);
        $this->getContent();
    }

    /*
    * Get ticket details
    */
    public function getContent(){
			$this->ticket = Ticket::where('slug', $this->link)->first();
        $this->ticket_id = $this->ticket->id;
        $this->tenant_id = $this->ticket->tenant_id;
        $this->user_id = $this->ticket->user_id;
        $this->messages = TicketConversation::where('ticket_id', $this->ticket_id)->get();
    }

    public function sendMessage(){
        $this->validate([
            'message'=>'required'
        ]);
        $conversation = new TicketConversation;
        $conversation->content = $this->message;
        $conversation->to_id = $this->user_id;
        $conversation->from_id = Auth::user()->id;
        $conversation->tenant_id = $this->tenant_id;
        $conversation->ticket_id = $this->ticket_id;
        $conversation->save();
        $this->message = '';
        $this->getContent();
        return back();
    }

    public function uploadAttachment(){
        return dd($this->attachment);
        $this->validate([
            'attachment'=>'required'
        ]);
        if(!empty($this->file('attachment'))){
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'support_'.uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        }else{
            $filename = '';
        }

        $conversation = new TicketConversation;
        $conversation->attachment = $filename;
        $conversation->user_id = $this->to_id;
        $conversation->from_id = Auth::user()->id;
        $conversation->tenant_id = $this->tenant_id;
        $conversation->ticket_id = $this->ticket_id;
        $conversation->save();
        $this->message = '';
        $this->getContent();
        return back();
    }

    public function closeTicket(){
        $ticket = Ticket::where('id', $this->ticket_id)->where('tenant_id', $this->tenant_id)->first();
        $ticket->status = 0; //closed
        $ticket->save();
        session()->flash("success", "<strong>Success!</strong> Ticket closed.");
        $this->getContent();
        return back();
    }
}
