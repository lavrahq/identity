@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
<div class="flex bg-gray-300 rounded shadow-2xl w-5/6">
    <div class="w-3/4 bg-gray-200 flex flex-col rounded px-6 py-6 shadow-lg">
        <img class="mb-6 self-center" src="{{ asset('/img/icon-192.png') }}" style="height: 60px" />

        <p class="text-gray-600 text-xs text-center font-light antialiased w-full">
            Please enter your password or select "Send an Email" to receive a one-time use
            logon email.
        </p>

        <form action="{{ route('auth.login.password') }}" method="POST" class="flex flex-col">
            @csrf

            <form-input
                name="email"
                label="Email Address"
                :value="$email->email"
                type="email"
                route="{{ route('auth.login.index') }}"
                link="Switch Accounts?"
                disabled
            />

            <form-input
                name="password"
                label="Password"
                placeholder="p@ssw0rd123!"
                type="password"
                focused
            />

            <div class="flex w-2/3 self-end mt-4">
                <a
                    href="#"
                    class="bg-gray-600 w-1/2 py-1 text-white text-xs text-center rounded shadow focus:outline-none"
                >
                    Send an Email
                </a>

                <button
                    type="submit"
                    class="bg-gray-700 w-1/2 py-1 ml-2 text-white text-xs rounded shadow focus:outline-none"
                >
                    Continue
                </button>
            </div>
        </form>

        <p class="text-xs text-center text-gray-600 font-light antialiased mt-6">
            Powered by <a href="#" class="border-b border-dashed border-gray-500 hover:border-solid">Lavra Identity</a>
        </p>
    </div>

    <div class="flex flex-col px-4 py-4 w-1/4 shadow-inner-lg">
        <a
            href="#"
            class="w-full bg-blue-600 text-center rounded py-1 text-xs text-white antialiased shadow-lg"
        >
            Facebook
        </a>

        <a
            href="#"
            class="w-full bg-purple-700 text-center rounded py-1 text-xs text-white antialiased shadow-lg mt-3"
        >
            Discord
        </a>
    </div>
</div>
@endsection
