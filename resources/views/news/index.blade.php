@extends('layouts.app')

@section('body')

    <h1 class="page-title">
        Jaunākās ziņas
        <a href="{{ route('news.create') }}" class="btn-sm">Izveidot</a>
    </h1>

    <div class="grid gap-4">
        @each('partials.post', $news, 'post')
    </div>

    {{ $news->links() }}

    @include('includes.sidebar')
    
    
@endsection