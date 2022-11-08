@extends('layouts.app')

@section('body')

    <h1 class="text-3xl font-bold mb-6">Jaunumi</h1>

    <div class="grid gap-4">
        @each('partials.post', $posts, 'post', 'partials.empty-post')
    </div>

    {{ $posts->links() }}

    @include('includes.sidebar')
    
    
@endsection