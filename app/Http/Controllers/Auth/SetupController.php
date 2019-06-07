<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Email;
use App\Entities\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\Setup\InitialSetupRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\Setup\SetPasswordRequest;

class SetupController extends Controller
{

    /**
     * Setup controller middleware.
     */
    public function __construct()
    {
        // $this->middleware('auth')
        //     ->except(['index', 'initial', 'password']);
    }

    /**
     * The default setup route.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $emailId = session('authorized_account_setup', old('email'));

        Log::info('User is beginning setup process.', ['email' => $emailId]);

        if (! $emailId) {
            Log::info('User does not have appropriate authorization.', ['email' => $emailId]);

            return redirect()
                ->route('auth.login.index');
        }

        if (! $email = Email::find($emailId)) {
            Log::warning('User attempted setup of non-registered email.', ['email' => $emailId]);

            return redirect()
                ->route('auth.login.index');
        }

        Log::info('User passed preflight. Setup view displayed.', ['email' => $email->id]);

        session()
            ->flash('authorized_account_setup', $email->id);

        return view('auth.setup.index')
            ->withEmail($email);
    }

    public function initial(InitialSetupRequest $request)
    {
        Log::info('User is POSTing a username to create their acount.', ['email' => request('email')]);

        if (! $email = Email::find(request('email'))) {
            Log::warning('User is attempting to use email that does not exist.', ['email' => request('email')]);

            return redirect()
                ->route('auth.login.index');
        }

        $user = new User();
        $user->username = request('username');
        $user->save();

        $email->user()
            ->associate($user)
            ->save();

        Auth::login($user, false);

        if (request('login_with') === 'password') {
            return redirect()
                ->route('auth.setup.password');
        }

        return redirect()
            ->route('portal.profile.first_time');
    }

    public function password(SetPasswordRequest $request)
    {
        dump('test');
        Log::info('User is setting a password.', ['user' => auth()->user()->id]);

        return view('auth.setup.password')
            ->withUser(auth()->user());
    }
}
