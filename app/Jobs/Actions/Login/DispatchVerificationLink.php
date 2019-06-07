<?php

namespace App\Jobs\Actions\Login;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Entities\Email;
use App\Notifications\Actions\Login\VerifyYourEmail;
use Illuminate\Support\Facades\URL;

class DispatchVerificationLink implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The newly created email.
     *
     * @var Email
     */
    public $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = URL::temporarySignedRoute(
            'click.verify.email',
            now()->addHour(),
            [
                'address' => $this->email->email
            ]
        );

        $this->email->notify(new VerifyYourEmail($url));
    }
}
