@extends('layouts.register')

@section('body')

<div class="grow m-auto max-w-md bg-white rounded-lg p-8 space-y-4">

    <div class="font-bold text-2xl flex items-center justify-between">
        Reģistrācija
        @include('partials.back-link')
    </div>

    <form 
        method="POST"
        action="{{ route('register') }}"
        class="space-y-4"
    >
        @csrf

        <x-input 
            label="Lietotājvārds"
            name="name"
            required
        />

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

        <x-input 
            label="Parole atkārtoti"
            name="password_confirmation"
            type="password"
            required
        />

        <button type="submit" class="btn-md">
            Reģistrēties
        </button>

    </form>

    <div>
        Jau esi reģistrējies?
        <a 
            href="{{ route('login') }}"
            class="text-sky-600 hover:underline"
        >
            Autentificēties
        </a>
    </div>

</div>
@endsection
