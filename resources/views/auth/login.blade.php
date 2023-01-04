@extends('layouts.register')

@section('body')

<div class="grow m-auto max-w-md bg-white rounded-lg p-8 space-y-4">

    <div class="font-bold text-2xl flex items-center justify-between">
        Autentifikācija
        <x-back-link route="{{ route('home') }}" />
    </div>

    <form 
        method="POST"
        action="{{ route('login') }}"
        class="space-y-4"
    >
        @csrf

        <x-input 
            label="E-pasta adrese"
            name="email"
            type="email"
            required
        />

        <x-input 
            label="Parole"
            name="password"
            type="password"
            required
        />

        <button type="submit" class="btn-md">
            Autentificēties
        </button>

    </form>

    <div class="flex gap-4">
        <a 
            href="{{ route('register') }}"
            class="text-sky-600 hover:underline"
        >
            Reģistrēties
        </a>

        <a 
            href="{{ route('password.request') }}"
            class="text-sky-600 hover:underline"
        >
            Aizmirsi paroli?
        </a>
    </div>

</div>
@endsection
