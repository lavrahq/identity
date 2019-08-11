<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Email;
use App\Jobs\Actions\Login\DispatchMagicLink;
use App\Jobs\Actions\Login\DispatchVerificationLink;
use App\Entities\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\Login\EmailRequest;
use App\Http\Requests\Auth\Login\PasswordLoginRequest;
use App\Http\Requests\OneTimePasswordRequest;

class LoginController extends Controller
{

    /**
     * Default middleware for the controllers.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the initial login screen for Identity.
     *
     * @return void
     */
    public function index() {
        return view('auth.login.index');
    }

    public function email(EmailRequest $request) {
        $email = Email::where('email', request('email'))
            ->first();

        if ($email) {
            if (! $email->verified_at) {
                dispatch(new DispatchVerificationLink($email));

                return redirect()
                    ->route('auth.login.verification_link');
            }

            $user = $email->user;
            $passwords = $user->passwords
                ->filter(function ($value) {
                    return  ($value->expired_at > now() ||
                             $value->expired_at === null);
                });

            if (! count($passwords)) {
                dispatch(new DispatchMagicLink($email));

                return redirect()
                    ->route('auth.login.link.index');
            }

            session()
                ->put('allowed', request('email'));

            return redirect()
                ->route('auth.login.password');
        }

        $email = new Email();
        $email->email = request('email');
        $email->save();

        // dispatch(new DispatchVerificationLink($email));

        return redirect()
            ->route('auth.login.verification_link');
    }

    public function password(Request $request)
    {
        if (session()->has('allowed')) {
            return view('auth.login.password')
                ->withEmail(
                    session()
                        ->get('allowed')
                );
        }

        return redirect()
            ->route('auth.login.index')
            ->withErrors([
                'email' => [
                    'Please try logging in again.'
                ]
            ])
            ->withInput();
    }

    public function withPassword(PasswordLoginRequest $request)
    {
        [ 'password' => $password_raw, 'email' => $email_raw ] = $request->validated();

        $email = Email::where('email', $email_raw)
            ->first();

        if (! $email) {
            return redirect()
                ->route('auth.login.password')
                ->withInput()
                ->withErrors([
                    'email' => [
                        'There was a problem while logging you in.'
                    ]
                ]);
        }

        $user = $email->user;
        $password = $user->currentPassword();

        if (Hash::check($password_raw, $password->password)) {
            Auth::login($user);

            return redirect()
                ->intended(route('portal.index'));
        }

        return redirect()
            ->route('auth.login.password')
            ->withInput()
            ->withErrors([
                'password' => [
                    'Please check your credentials. Your password was last modified 0 days ago.'
                ]
            ]);
    }

    public function verificationLink()
    {
        return view('auth.login.verification_sent');
    }

    public function link()
    {
        if (session()->has('allowed')) {
            return view('auth.login.link.index')
                ->withEmail(
                    session()
                        ->get('allowed')
                );
        }

        return redirect()
            ->route('auth.login.index')
            ->withErrors([
                'email' => [
                    'Please try logging in again.'
                ]
            ])
            ->withInput();
    }

    public function withOneTimePassword(OneTimePasswordRequest $request)
    {
        $method = request('method');

        if (session()->has('allowed')) {
            $email = Email::where('email', session()->get('allowed'))
                ->first();

            if ($method == 'link') {
                dispatch(new DispatchMagicLink($email));
            } else if ($method == 'code') {
    
            }
        }

    }
}
