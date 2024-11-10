<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    protected $message;
    protected $orderId;
    
    public function __construct($message, $orderId)
    {
        $this->message = $message;
        $this->orderId = $orderId;
    }

    public function via(object $notifiable): array
    {
        // return ['mail', 'database'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line($this->message)
    //                 ->action('Notification Action', url('/orders '))
    //                 ->line('A request to cancel the order has been sent.');
    // }

    public function toArray(object $notifiable)
    {
        return [
            'message' => $this->message,
            'order_id' => $this->orderId,
        ];
    }
}
