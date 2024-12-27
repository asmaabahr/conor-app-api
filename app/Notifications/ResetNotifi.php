<?php

namespace App\Notifications;
use Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Http\Controllers\Auth\AuthController;

class ResetNotifi extends Notification
{
    use Queueable;
    public $message;
    public $subject;
    public $fromemail;
    public $mailer;
    private $otp;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->message = "use the below code for resetting password";
        $this->subject = "Reset Your Password";
        $this->fromemail = "hamoahmed4567@gmail.com";
        $this->mailer = "smtp";
        $this->otp = new Otp;
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

    public function toMail(object $notifiable)
    {
        $otp = $this->otp->generate($notifiable->email,'numeric',6 ,15);
        return (new MailMessage)
        ->mailer('smtp')
        ->subject($this->subject)
        ->greeting('Hello ' . $notifiable->name)
        ->line($this->message)
        ->line('code:'. $otp->token);

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
