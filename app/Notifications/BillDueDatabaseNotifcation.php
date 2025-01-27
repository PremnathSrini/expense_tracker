<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BillDueDatabaseNotification extends Notification
{
    use Queueable;
    protected $bill;

    /**
     * Create a new notification instance.
     */
    public function __construct($bill)
    {
        $this->bill = $bill;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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

    public function toDatabase($notifiable){
        return [
            'bill_id' => $this->bill->id,
            'message' => "Your bill #{$this->bill->id} is due soon. Please pay before the due date.",
            'due_date' => $this->bill->due_date,
        ];
    }
}
