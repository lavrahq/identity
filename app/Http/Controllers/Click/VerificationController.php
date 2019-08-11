<?php

namespace App\Http\Controllers\Click;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Email;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function email(Request $request, $address) {
        if (! $request->hasValidSignature()) {
            return redirect()
                ->to('auth.login.index');
        }

        $email = Email::where('email', $address)
            ->first();

        if (! $email) {
            return redirect()
                ->to('auth.login.index');
        }

        session()
            ->flash('authorized_account_setup', $email->id);

        return redirect()
            ->route('auth.setup.index');
    }

    public function link(Request $request) {
        return view('auth.login.index');
    }
}
