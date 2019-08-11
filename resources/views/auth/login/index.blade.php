@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
<div class="flex bg-gray-300 rounded shadow-2xl w-5/6">
    <div class="w-3/4 bg-gray-200 flex flex-col rounded px-6 py-6 shadow-lg">
        <img class="mb-6 self-center" src="{{ asset('/img/lavra.png') }}" style="height: 60px" />

        <p class="text-gray-600 text-xs text-center font-light antialiased w-full">
            Welcome to Identity! Administrators may customize this message within the
            the Identity settings to welcome users to the site, or, provide disclaimers.
        </p>

        <form action="{{ route('auth.login.index') }}" method="POST" class="flex flex-col">
            @csrf

            <form-input
                name="email"
                label="Email"
                placeholder="john.doe@example.org"
                type="email"
            />

            <button
                type="submit"
                dusk="continue"
                class="bg-gray-700 w-1/3 self-end py-1 mt-2 text-white text-xs rounded shadow focus:outline-none"
            >
                Continue
            </button>
        </form>

        <p class="text-xs text-center text-gray-600 font-light antialiased mt-6">
            By logging in, you consent to your IP Address being stored and session cookies being utilized.
            <br />
            <br />

            Powered by <a href="#" class="border-b border-dashed border-gray-500 hover:border-solid">{{ config('app.name') }}</a>
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
