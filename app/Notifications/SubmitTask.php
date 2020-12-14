<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\PostSubmission;
use App\Post;
use Auth;
class SubmitTask extends Notification
{
    use Queueable;
    public $post, $message, $content;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PostSubmission $post, Post $content)
    {
        $this->post = $post;
        $this->content = $content;
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
            'post_title'=>$this->content->post_title ?? 'Unknown title',
            'post_content'=>Auth::user()->first_name.' just submitted task.',
            'post_author'=>Auth::user()->first_name,
            'url'=>$this->content->post_url,
            'post_type'=>$this->content->post_type,
            'avatar'=>Auth::user()->avatar
        ];
    }
}
