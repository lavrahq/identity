<?php

namespace App\Http\Controllers\Auth;

use App\Entities\Email;
use App\Entities\Password;
use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register\FinishRegistrationRequest;
use App\Http\Requests\Auth\Register\RegistrationRequest;
use App\Http\Requests\Auth\Register\SetupPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle initial user registration after verifying
     * their email address is valid.
     *
     * @param RegistrationRequest $request
     *
     * @return void
     */
    public function index(RegistrationRequest $request)
    {
        if (!$request->hasValidSignature()) {
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
     *
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
     *
     * @return void
     */
    public function password(Request $request)
    {
        $userId = session('user_id');

        if (auth()->user()) {
            $userId = auth()->user()->id;
        }

        if (!auth()->user()) {
            Auth::loginUsingId($userId);
        }

        return view('auth.register.password')
            ->withUserId($userId);
    }

    public function setPassword(SetupPasswordRequest $request)
    {
        ['user_id' => $userId, 'password' => $rawPassword] = $request->validated();

        $user = User::find($userId);

        if (! $user) {
            return redirect()
                ->route('auth.login.index');
        }

        $password = new Password();
        $password->password = Hash::make($rawPassword);
        $password->expired_at = now()->addYear();
        $password->user()
            ->associate($user)
            ->save();

        if (! auth()->user()) {
            Auth::loginUsingId($userId);
        }

        return redirect()
            ->route('portal');
    }
}
