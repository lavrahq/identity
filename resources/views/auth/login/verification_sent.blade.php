@extends('layouts.auth')

@section('title')
    Action Required
@endsection

@section('content')
<div class="flex bg-gray-300 rounded shadow-2xl w-5/6">
    <div class="w-full bg-gray-200 flex flex-col rounded px-6 py-6 shadow-lg">
        <img class="mb-6 self-center" src="{{ asset('/img/lavra.png') }}" style="height: 60px" />

        <p class="text-gray-600 text-center font-light w-full mb-8">
            Check your email for a verification link!

            <br />
            <a href="{{ route('auth.login.index') }}" class="text-xs text-center border-b border-dashed border-gray-500 hover:border-solid">
                Didn't receive the email? Login again!
            </a>
        </p>

        <img src="{{ asset('img/mail_received.svg') }}" style="height: 150px" />

        <p class="text-xs text-center text-gray-600 font-light antialiased mt-8">
            Powered by <a href="#" class="border-b border-dashed border-gray-500 hover:border-solid">Lavra Identity</a>
        </p>
    </div>
</div>
@endsection
