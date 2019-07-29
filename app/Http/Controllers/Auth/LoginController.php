<?php

namespace App\Http\Controllers\Auth;

use App\Entities\Email;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login\EmailRequest;
use App\Notifications\User\CompleteAccountSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class LoginController extends Controller
{
    /**
     * The default login page that is displayed.
     *
     * @return View
     */
    public function index()
    {
        return view('auth.login.index');
    }

    /**
     * Process the initial login step when the email
     * or username is processed.
     *
     * @param EmailRequest $request
     *
     * @return void
     */
    public function email(EmailRequest $request)
    {
        $requestEmail = request('email');

        $email = Email::where('email', $requestEmail)
                ->first();

        if ($email == null) {
            Notification::route('mail', $requestEmail)
                    ->notify(new CompleteAccountSetup());

            return view('auth.login.verification_sent')
                ->withEmail($requestEmail);
        }
    }
}
