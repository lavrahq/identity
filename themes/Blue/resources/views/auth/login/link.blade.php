@extends('layouts.auth')

@section('title')
    One Time Password
@endsection

@section('content')
<div class="flex bg-gray-300 rounded shadow-2xl w-5/6">
    <div class="w-full bg-gray-200 flex flex-col rounded px-6 py-6 shadow-lg">
        <img class="mb-6 self-center" src="{{ asset('/img/icon-192.png') }}" style="height: 60px" />

        <p class="text-gray-600 text-center font-light w-full mb-2">
            One Time Password Authentication
        </p>

        <div class="flex justify-center">
            <button
                type="submit"
                class="bg-gray-700 w-1/3 py-1 m-2 text-white text-xs rounded shadow focus:outline-none"
            >
               Link 
            </button>
    
            <button
                type="submit"
                class="bg-gray-700 w-1/3 py-1 m-2 text-white text-xs rounded shadow focus:outline-none"
            >
                Code
            </button>
        </div>

        <p class="text-xs text-center text-gray-600 font-light antialiased mt-8">
            Powered by <a href="#" class="border-b border-dashed border-gray-500 hover:border-solid">Lavra Identity</a>
        </p>
    </div>
</div>
@endsection
