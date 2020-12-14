<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\WorkgroupInvite;
use App\Workgroup;
use App\User;
use Auth;
class WorkgroupInviteNotification extends Notification
{
    use Queueable;
    public $invite;
    public $workgroup;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(WorkgroupInvite $invite, Workgroup $workgroup)
    {
        $this->invite = $invite;
        $this->workgroup = $workgroup;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'post_title'=>$this->workgroup->group_name,
            'post_content'=>$this->invite->message,
            'post_author'=>Auth::user()->first_name." ".Auth::user()->surname ?? '',
            'url'=>$this->invite->slug,
            'post_type'=>'workgroup-invite',
            'avatar'=>Auth::user()->avatar
        ];
    }
}
