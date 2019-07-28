<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Email;
use Illuminate\Support\Str;
use App\Notifications\User\CompleteAccountSetup;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\Auth\Login\EmailRequest;

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
     * @return void
     */
    public function email(EmailRequest $request)
    {
        $requestEmail = request('email');

        $email = Email::where('email', $requestEmail)
                ->first();

        if ($email == null) {
            Notification::route('mail', $requestEmail)
                    ->notify(new CompleteAccountSetup);

            return view('auth.login.verification_sent')
                ->withEmail($requestEmail);
        }
    }
}
