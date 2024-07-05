<?php

namespace App\Notifications;

use Illuminate\Notifications\Notifiable;

class EmailNotifiable
{
    use Notifiable;
    protected $email;
    /**
     * Create a new class instance.
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    public function routeNotificationEmail($notification){
        return $this->email;
    }
}
