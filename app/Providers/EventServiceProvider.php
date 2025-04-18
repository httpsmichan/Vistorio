<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
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
    
     protected $listen = [
        Failed::class => [
            LogFailedLogin::class,
        ],
    ];
    
    public function boot(): void
    {
        parent::boot();
    }


}
