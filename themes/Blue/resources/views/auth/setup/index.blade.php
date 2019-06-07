@extends('layouts.auth')

@section('title')
    Setup Your Account
@endsection

@section('content')
<div class="flex bg-gray-300 rounded shadow-2xl w-5/6">
    <div class="w-full bg-gray-200 flex flex-col rounded px-6 py-6 shadow-lg">
        <img class="mb-6 self-center" src="{{ asset('/img/icon-192.png') }}" style="height: 60px" />

        <p class="text-gray-600 text-center font-light w-full mb-2">
            Hey there! Welcome to {{ config('dbs.community_name') }}.
        </p>

        <form action="{{ route('auth.setup.index') }}" method="POST" class="flex flex-col">
            @csrf

            <input type="hidden" name="email" value="{{ $email->id }}" />

            <form-input
                name="username"
                label="Set a Username"
                placeholder="JohnDoe2019"
                :value="old('username')"
            />

            <p class="text-gray-600 text-left text-xs w-full mt-4 mb-2">
                <strong>Passwords aren't that secure.</strong> Would you like to use a modern
                login experience allowing you to login without a password? We'll send you
                a link via email when you login, click the button and you're in.
            </p>

            <div class="flex justify-around">
                <button
                    name="login_with"
                    value="password"
                    type="submit"
                    class="bg-gray-600 w-2/5 self-end py-1 mt-2 text-white text-xs rounded shadow focus:outline-none"
                >
                    Set a Password
                </button>

                <button
                    name="login_with"
                    value="links"
                    type="submit"
                    class="bg-gray-700 w-2/5 self-end py-1 mt-2 text-white text-xs rounded shadow focus:outline-none"
                >
                    Send Login Emails
                </button>
            </div>
        </form>

        <p class="text-xs text-center text-gray-600 font-light antialiased mt-6">
            Powered by <a href="#" class="border-b border-dashed border-gray-500 hover:border-solid">Lavra Identity</a>
        </p>
    </div>
</div>
@endsection
