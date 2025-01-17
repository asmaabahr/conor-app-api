<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactNotifi extends Notification
{
    use Queueable;

    public $subject;
    public $fromemail;
    public $mailer;
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
       
        $this->subject = "Contact Form Submission";
        $this->fromemail = "hamoahmed4567@gmail.com";
        $this->mailer = "smtp";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                 ->mailer('smtp')
                 ->subject($this->subject)
                 ->greeting('Hi '.$notifiable->name)
                 ->line('We Got Your Message!')
                 ->line('Thank you for contacting Connor!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
