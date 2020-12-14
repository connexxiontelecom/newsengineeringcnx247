<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\QueryEmployee;
use Auth;

class QueryEmployeeNotification extends Notification
{
    public $query;
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(QueryEmployee $query)
    {
        $this->query = $query;
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
            'post_title'=>$this->query->subject,
            'post_content'=>substr($this->query->query_content,0,35),
            'post_author'=>Auth::user()->first_name.' '.Auth::user()->surname ?? '',
            'url'=>$this->query->slug,
            'post_type'=>'query',
            'avatar'=>Auth::user()->avatar
        ];
    }
}
