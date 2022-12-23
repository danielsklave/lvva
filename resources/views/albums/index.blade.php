@extends('layouts.app')

@section('body')

    <h1 class="page-title">
        Galerija
        <a href="{{ route('albums.create') }}" class="btn-sm">Izveidot</a>
    </h1>

    <ul class="space-y-4">
        @each('partials.post', $albums, 'post')
    </ul>

    {{ $albums->links() }}
    
@endsection