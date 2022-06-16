<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class OrderNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public static $message = [];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        self::$message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // dd(self::$message);
        return (new MailMessage)
            ->subject('Order Confirmation Mail')
            ->greeting(self::$message['greeting'])
            ->line(self::$message['body'])
            ->action(self::$message['actionText'], self::$message['actionURL'])
            ->line(self::$message['thanks'])
            ->attach(self::$message['attach_url'], [
                'as' => self::$message['attach_as'],
                'mime' => self::$message['attach_type'],
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message_id' => $this->message['id']
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
