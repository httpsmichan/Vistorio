<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogFailedLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Failed $event): void
    {
        DB::table('login_attempts')->insert([
            'email' => $event->credentials['email'],
            'ip_address' => Request::ip(),
            'status' => 'failed',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
