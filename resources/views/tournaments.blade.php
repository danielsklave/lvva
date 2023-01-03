@extends('layouts.app')

@section('body')

    <div class="page-title">
        <h1>Sacensības</h1>

        <div class="flex gap-2">
            <x-filters route="{{ route('tournaments.index') }}" />

            @admin
                <a href="{{ route('tournaments.create') }}" class="btn-sm">
                    Izveidot
                </a>
            @endadmin
        </div>
    </div>

    <x-year-accordion :postsByYear="$tournamentsByYear" />

@endsection