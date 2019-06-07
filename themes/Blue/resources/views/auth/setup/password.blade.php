@extends('layouts.auth')

@section('title')
    Setup Your Account
@endsection

@section('content')
<div class="flex bg-gray-300 rounded shadow-2xl w-5/6">
    <div class="w-full bg-gray-200 flex flex-col rounded px-6 py-6 shadow-lg">
        <img class="mb-6 self-center" src="{{ asset('/img/icon-192.png') }}" style="height: 60px" />

        <p class="text-gray-600 text-center font-light w-full mb-2">
            You can set your password here, {{ $user->username }}.
        </p>

        <form action="{{ route('auth.setup.password') }}" method="POST" class="flex flex-col">
            @csrf

            <input type="hidden" name="email" value="{{ $email->id }}" />

            <form-input
                name="password"
                type="password"
                label="Set a Password"
                placeholder="p@ssw0rd123"
                :value="old('password')"
            />

            <form-input
                name="password_confirmation"
                type="password"
                label="Confirm Your Password"
                placeholder="p@ssw0rd123"
                :value="old('password_confirmation')"
            />

            <button
                type="submit"
                class="bg-gray-700 w-2/5 self-end py-1 mt-2 text-white text-xs rounded shadow focus:outline-none mt-4"
            >
                Set & Continue
            </button>
        </form>

        <p class="text-xs text-center text-gray-600 font-light antialiased mt-6">
            Powered by <a href="#" class="border-b border-dashed border-gray-500 hover:border-solid">Lavra Identity</a>
        </p>
    </div>
</div>
@endsection
