<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceprovide extends ServiceProvider
{
    protected $listen=[
        'App\Events\SubmitOrder' => [
            'App\Listeners\SubmitOrderEvent'
        ]
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
