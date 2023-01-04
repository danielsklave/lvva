@extends('layouts.register')

@section('body')

<div class="grow m-auto max-w-md bg-white rounded-lg p-8 space-y-4">

    <div class="font-bold text-2xl flex items-center justify-between">
        Paroles atjaunošana
        <x-back-link route="{{ route('home') }}" />
    </div>

    @if (session('status'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form 
        method="POST"
        action="{{ route('password.update') }}"
        class="space-y-4"
    >
        @csrf

        <input
            type="hidden"
            name="token"
            value="{{ $token }}"
        >

        <x-input 
            label="E-pasta adrese"
            name="email"
            type="email"
            value="{{ Request::get('email') }}"
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
            Atjaunot paroli
        </button>
    </form>
</div>
@endsection
