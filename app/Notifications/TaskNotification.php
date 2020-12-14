<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Post;
use App\ResponsiblePerson;
use Auth;

class TaskNotification extends Notification
{
    use Queueable;
    public $post;
    public $person;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
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
            'post_title'=>'New task titled '.$this->post->post_title ?? 'Unknown title',
            'post_content'=>$this->post->post_content,
            'post_author'=>$this->post->user->first_name.' '.$this->post->user->surname ?? '',
            'url'=>$this->post_url,
            'post_type'=>$this->post->post_type,
            'avatar'=>Auth::user()->avatar
        ];
    }
}
