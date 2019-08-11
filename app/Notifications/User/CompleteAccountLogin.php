<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use App\Entities\LoginAttempt;

class CompleteAccountLogin extends Notification
{
    use Queueable;

    public $loginAttempt;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(LoginAttempt $loginAttempt)
    {
        $this->loginAttempt = $loginAttempt;
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
        return (new MailMessage())
            ->subject('Complete Account Login for '.config('identity.org.name'))
            ->markdown('mail.user.generate_magic_link', [
                'magic_link' => URL::temporarySignedRoute(
                    'auth.login.magic_link',
                    now()->addMinutes(5),
                    [
                        'attempt' => $this->loginAttempt->id,
                        'ip' => $this->loginAttempt->ip_address_id,
                        'subject' => $this->loginAttempt->user_id
                    ]
                ),
            ]);
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
