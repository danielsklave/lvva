@extends('layouts.register')

@section('body')

<div class="grow m-auto max-w-md bg-white rounded-lg p-8 space-y-4">

    <div class="font-bold text-2xl flex items-center justify-between">
        Atjaunot paroli
        <x-back-link route="{{ route('login') }}" />
    </div>

    @if (session('status'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form 
        method="POST"
        action="{{ route('password.email') }}"
        class="space-y-4"
    >
        @csrf

        <x-input 
            label="E-pasta adrese"
            name="email"
            type="email"
            required
        />

        <button type="submit" class="btn-md">
            Nosūtīt atjaunošanas saiti
        </button>

    </form>

</div>
@endsection
