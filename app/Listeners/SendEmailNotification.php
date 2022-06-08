<?php

namespace App\Listeners;

use App\Events\SendEmailToUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        // 
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendEmailToUser  $event
     * @return void
     */
    public function handle(SendEmailToUser $event)
    {
        //We can send a mail from here
        $user = User::find($event->user_id)->toArray();
        Mail::send('user.mail', $user, function ($message) use ($user) {
            $message->to($user['email']);
            $message->subject('Event Testing');
        });

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/custom.log'),
        ])->info('User Created: ' . $user['email']);

    }
}
