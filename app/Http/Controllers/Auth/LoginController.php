<?php

namespace App\Http\Controllers\Auth;

use App\Entities\Email;
use App\Entities\IpAddress;
use App\Entities\LoginAttempt;
use App\Entities\Password;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login\EmailRequest;
use App\Http\Requests\Auth\Login\LinkLoginRequest;
use App\Http\Requests\Auth\Login\PasswordLoginRequest;
use App\Notifications\User\CompleteAccountLogin;
use App\Notifications\User\CompleteAccountSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * The default login page that is displayed.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $ipAddress = IpAddress::firstOrCreate([
            'ip_address' => $request->ip(),
        ]);

        $loginAttempt = new LoginAttempt();
        $loginAttempt
            ->ipAddress()
            ->associate($ipAddress);
        $loginAttempt->save();

        Cookie::queue(
            'idltoken',
            $loginAttempt->id,
            60 * 5
        );

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
        if (!$request->hasCookie('idltoken')) {
            return redirect()
                ->route('auth.login.index');
        }

        $requestEmail = request('email');

        $email = Email::where('email', $requestEmail)
                ->first();

        if ($email == null) {
            Notification::route('mail', $requestEmail)
                    ->notify(new CompleteAccountSetup());

            return view('auth.login.verification_sent')
                ->withEmail($requestEmail);
        }

        $loginAttempt = LoginAttempt::find($request->cookie('idltoken'));
        $loginAttempt->user()
            ->associate($email->user);
        $loginAttempt->save();

        $password = Password::whereDate('expired_at', '>', now())
            ->orWhere('expired_at', null)
            ->where('user_id', $email->user->id)
            ->first();

        if (!$password) {
            // TODO: Send OTP Email
        }

        return redirect()
            ->route('auth.login.link');
    }

    public function password(Request $request)
    {
        $loginAttempt = LoginAttempt::find($request->cookie('idltoken'));
        if (!$loginAttempt->user) {
            return redirect()
                ->route('auth.login.index');
        }

        return view('auth.login.password')
            ->withEmail($loginAttempt->user->primaryEmail());
    }

    public function withPassword(PasswordLoginRequest $request)
    {
        ['email' => $rawEmail, 'password' => $rawPassword] = $request->validated();

        $email = Email::where('email', $rawEmail)
            ->first();

        $password = Password::whereDate('expired_at', '>', now())
            ->orWhere('expired_at', null)
            ->where('user_id', $email->user->id)
            ->first();

        $validator = Validator::make(
            $request->all(),
            [
                'password' => function ($a, $value, $fail) use ($password) {
                    if (!Hash::check($value, $password->password)) {
                        $fail(trans('validation.password'));
                    }
                },
            ],
            ['password' => trans('validation.password')]
        );

        $loginAttempt = LoginAttempt::find($request->cookie('idltoken'));

        if ($validator->fails()) {
            $next = $loginAttempt->replicate();
            $next->push();

            Cookie::queue(
                'idltoken',
                $next->id,
                60 * 5
            );

            $loginAttempt->is_successful = false;
            $loginAttempt->save();

            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $loginAttempt->is_successful = true;
        $loginAttempt->save();

        Auth::loginUsingId($loginAttempt->user->id);

        return redirect()
            ->intended(route('portal'));
    }

    public function link(Request $request)
    {
        if (!$request->hasCookie('idltoken')) {
            return redirect()
                ->route('auth.login.index');
        }

        $loginAttempt = LoginAttempt::find($request->cookie('idltoken'));

        $loginAttempt->user->primaryEmail()
            ->notify(new CompleteAccountLogin($loginAttempt));

        return view('auth.login.link');
    }

    /**
     * Process the clicking of the magic link.
     *
     * @param LinkLoginRequest $request
     *
     * @return void
     */
    public function withLink(LinkLoginRequest $request)
    {
        $attemptId = request('attempt');
        $ipId = request('ip');
        $subjectId = request('subject');

        $loginAttempt = LoginAttempt::find($attemptId);

        if ($ipId != $loginAttempt->ip_address_id || $subjectId != $loginAttempt->user_id) {
            return redirect()
                ->route('auth.login.index')
                ->withErrors([
                    'email' => 'Please enter your email again.',
                ]);
        }

        Auth::loginUsingId($loginAttempt->user->id);

        return redirect()
            ->intended(route('portal'));
    }
}
