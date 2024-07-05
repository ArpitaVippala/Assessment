<?php

namespace App\Listeners;

use App\Events\SubmitOrder;
use App\Notifications\EmailNotifiable;
use App\Notifications\SendAdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\sendNotifications;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SubmitOrderEventListener implements ShouldQueue
{
    use InteractsWithQueue;
    
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    
    }

    /**
     * Handle the event.
     */
    public function handle(SubmitOrder $orderEvent)
    {
        $user = User::where('email', $orderEvent->order->email)->first();
        // dd($user);
        $user->notify(new sendNotifications($orderEvent)); //send notification to user
        //get the custom email id
        $adminUser = new EmailNotifiable('warehouse@example.org');
        Notification::send($adminUser, new SendAdminNotification($orderEvent)); //send notification to Admin
    }
}
