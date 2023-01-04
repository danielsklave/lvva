@extends('layouts.app')

@section('body')

    <div class="page-title">
        <h1>Profils</h1>

        <form action="{{ route('users.destroy', $user) }}" method="POST">
            @csrf @method('DELETE')
            <button class="delBtn btn-sm" type="submit">Dzēst</button>
        </form>
    </div>

    <dl class="max-w-md text-gray-900 divide-y divide-gray-200">
        <div class="flex flex-col pb-3">
            <dt class="mb-1 text-gray-500 md:text-lg">
                Lietotājvārds
            </dt>
            <dd class="text-lg font-semibold">
                {{ $user->name }}
            </dd>
        </div>
        <div class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 md:text-lg">
                E-pasta adrese
            </dt>
            <dd class="text-lg font-semibold">
                {{ $user->email }}
            </dd>
        </div>
        <div class="flex flex-col pt-3">
            <dt class="mb-1 text-gray-500 md:text-lg">
                Reģistrācijas laiks
            </dt>
            <dd class="text-lg font-semibold">
                {{ $user->updated_at->formatLocalized('%d.%m.%Y %R') }}
            </dd>
        </div>
    </dl>

    <br/>

    <h3 class="text-xl font-bold">
        Nomainīt paroli
    </h3>

    <form 
        class="space-y-4 max-w-md" 
        action="{{ route('users.change_password') }}" 
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        <x-input
            name="current_password"
            label="Esošā parole"
            type="password"
            required
        />
        <x-input
            name="new_password"
            label="Jaunā parole"
            type="password"
            required
        />
        <x-input
            name="new_password_confirmation"
            label="Jaunā parole atkārtoti"
            type="password"
            required
        />
        <button class="btn-md" type="submit">
            Saglabāt
        </button>
    </form>

    <script>
        document.querySelectorAll('.delBtn').forEach(delBtn =>
            delBtn.addEventListener("click", e =>
                !confirm('Vai tiešām vēlaties dzēst lietotāju?') && e.preventDefault()
            )
        );
    </script>

@endsection
