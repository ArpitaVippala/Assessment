<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Orders;
use Illuminate\Support\Facades\Log;
use App\Models\Products;

class sendNotifications extends Notification implements ShouldQueue
{
    use Queueable;

    public $message;
    
    /**
     * Create a new notification instance.
     */
    public function __construct($message)
    {
        $this->message = $message;
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
        $productsArr = ($this->message->order->orderItems)->toArray();
        $products = array_column($productsArr, 'product_id');
        $productFetch = Products::whereIN('id', $products)->pluck('name')->toArray();
        $productNames = implode(',',$productFetch);
        return (new MailMessage)
                    ->greeting('Hello')
                    ->line('Thank you for the order. Check the below ordered products')
                    ->line("Products: $productNames")
                    ->line('Thank you! Have a nice day');
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
