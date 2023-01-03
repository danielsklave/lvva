@extends('layouts.app')

@section('body')

    <div class="page-title">
        <h1>Konkursi</h1>

        <div class="flex gap-2">
            <x-filters route="{{ route('contests.index') }}" />

            @admin
                <a href="{{ route('contests.create') }}" class="btn-sm">
                    Izveidot
                </a>
            @endadmin
        </div>
    </div>

    <x-year-accordion :postsByYear="$contestsByYear" />

@endsection