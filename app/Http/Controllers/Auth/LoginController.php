<?php

namespace App\Http\Controllers\Auth;

use App\Entities\Email;
use App\Entities\Password;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login\EmailRequest;
use App\Http\Requests\Auth\Login\PasswordLoginRequest;
use App\Notifications\User\CompleteAccountSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\MessageBag;
use Mockery\Generator\StringManipulation\Pass\Pass;

class LoginController extends Controller
{
    /**
     * The default login page that is displayed.
     *
     * @return View
     */
    public function index()
    {
        // TODO: setup a LoginAttempt to log attempts and info about attempts. Pass it through the rest.

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

        $password = Password::whereDate('expired_at', '>', now())
            ->where('user_id', $email->user->id)
            ->first();

        if (!$password) {
            // TODO: Send OTP Email
        }

        // $cookie = cookie('idlw', $email->email, 300, route('auth.login.password'), config('app.domain'), false, true);

        return redirect()
            ->route('auth.login.password')
            ->with('email', $email->email);
    }

    public function password(Request $request)
    {
        if (!$email = $request->session()->get('email')) {
            return redirect()
                ->route('auth.login.index');
        }

        return view('auth.login.password')
            ->withEmail($email);
    }

    public function withPassword(PasswordLoginRequest $request)
    {
        ['email' => $rawEmail, 'password' => $rawPassword] = $request->validated();

        $email = Email::where('email', $rawEmail)
            ->first();

        if (!$email) {
            return redirect()
                ->route('auth.login.index')
                ->with('error', 'Identity ran into a problem logging you in. Please try again.');
        }

        $password = Password::whereDate('expired_at', '>', now())
            ->where('user_id', $email->user->id)
            ->first();

        if (!Hash::check($rawPassword, $password->password)) {
            $messages = new MessageBag([
                'password' => 'The password provided is invalid.',
            ]);

            return view('auth.login.password')
                ->withEmail($rawEmail)
                ->withErrors($messages);
        }
    }
}
