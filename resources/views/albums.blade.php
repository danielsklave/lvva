@extends('layouts.app')

@section('body')

    <div class="page-title">
        <h1>Galerija</h1>

        <div class="flex gap-2">
            <x-filters route="{{ route('albums.index') }}" />

            @admin
                <a href="{{ route('albums.create') }}" class="btn-sm">
                    Izveidot
                </a>
            @endadmin
        </div>
    </div>

    <ul class="space-y-4">
        @each('partials.post', $albums, 'post', 'partials.empty')
    </ul>

    {{ $albums->links() }}
    
@endsection