<?php

namespace App\Listeners;

use App\Events\SendEmailToUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/custom.log'),
        ])->info('Event Listner ');
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendEmailToUser  $event
     * @return void
     */
    public function handle(SendEmailToUser $event)
    {
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/custom.log'),
        ])->info('User Created: ' . $event->email.json_encode($event));
        //We can send a mail from here
    }
}
