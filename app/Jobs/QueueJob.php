<?php

namespace App\Jobs;

use App\Mail\SendBlogEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class QueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_mail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_mail)
    {
        $this->user_mail = $user_mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendBlogEmail();
        Mail::to($this->user_mail)->send($email);
    }
}
