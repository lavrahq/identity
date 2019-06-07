<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Email;
use App\Http\Requests\Auth\Login\EmailRequest;
use App\Jobs\Actions\Login\DispatchMagicLink;
use App\Jobs\Actions\Login\DispatchVerificationLink;

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

            if (! $user->password) {
                dispatch(new DispatchMagicLink($user));

                return redirect()
                    ->route('auth.login.link_sent');
            }
        }

        $email = new Email();
        $email->email = request('email');
        $email->save();

        dispatch(new DispatchVerificationLink($email));

        return redirect()
            ->route('auth.login.verification_link');
    }

    public function verificationLink()
    {
        return view('auth.login.verification_sent');
    }

}
