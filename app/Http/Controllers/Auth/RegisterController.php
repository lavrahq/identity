<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register\RegistrationRequest;
use App\Entities\Email;
use App\Entities\User;
use App\Http\Requests\Auth\Register\FinishRegistrationRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\Register\SetupPasswordRequest;

class RegisterController extends Controller
{
    /**
     * Handle initial user registration after verifying
     * their email address is valid.
     *
     * @param RegistrationRequest $request
     * @return void
     */
    public function index(RegistrationRequest $request)
    {
        if (! $request->hasValidSignature()) {
            return redirect()
                ->route('auth.login.index');
        }

        $email = Email::where('email', request('email'))
            ->first();

        if ($email != null) {
            return view('auth.register.index')
                ->withEmailId($email->id);
        }

        $user = new User();
        $user->save();

        $email = new Email();
        $email->email = request('email');
        $email->verified_at = now();
        $email->status = 'primary';
        $email->user()
            ->associate($user)
            ->save();

        return view('auth.register.index')
            ->withEmailId($email->id);
    }

    /**
     * Have user decide whether to login via password or link and save preference.
     *
     * @param FinishRegistrationRequest $request
     * @return void
     */
    public function finish(FinishRegistrationRequest $request)
    {
        ['email_id' => $emailId, 'login_with' => $loginWith] = $request->validated();

        $email = Email::find($emailId);
        if ($email == null) {
            return redirect()
                ->route('auth.login.index');
        }

        if ($loginWith === 'links') {
            if (Auth::loginUsingId($email->user->id)) {
                return redirect()
                    ->route('portal');
            }
        }

        return redirect()
            ->route('auth.register.password')
            ->with('user_id', $email->user->id);
    }

    /**
     * Show a form to set the current User's password.
     *
     * @param Request $request
     * @return void
     */
    public function password(Request $request)
    {
        if (! request()->has('user_id')) {
            return redirect()
                ->route('auth.login.index');
        }

        return view('auth.register.password')
            ->withUserId(session('user_id'));
    }

    public function setPassword(SetupPasswordRequest $request)
    {
        Auth::loginUsingId(
            session('user_id')
        );

        return redirect()
            ->route('portal');
    }
}
