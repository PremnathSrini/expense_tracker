<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BillDueNotification extends Notification
{
    use Queueable,Dispatchable;

    public $user,$bill;

    /**
     * Create a new notification instance.
     */
    public function __construct($user,$bill)
    {
        $this->user = $user;
        $this->bill = $bill;
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
                    ->subject('Upcoming Bill Reminder')
                    ->greeting('Hello '. $this->user->name)
                    ->line('This is a reminder that your bill "' . $this->bill->name . '" is due on ' . $this->bill->due_date->format('d M Y') . '.')
                    ->line('Amount: ₹' . number_format($this->bill->amount, 2))
                    ->action('View Bill', url('/bills'))
                    ->line('Please pay it on time to avoid penalties.');
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
