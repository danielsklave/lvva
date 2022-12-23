@extends('layouts.app')

@section('body')

    <h1 class="page-title">
        Jaunākās ziņas
        <a href="/posts" class="style-links text-base gap-2">
            Ziņas <i class="fa-solid fa-arrow-right"></i>
        </a>
    </h1>

    <div class="grid gap-4 lg:grid-cols-3">
        @each('partials.compact-post', $news, 'post')
    </div>

    <h1 class="page-title">
        Jaunākie albumi
        <a href="/albums" class="style-links text-base gap-2">
            Galerija <i class="fa-solid fa-arrow-right"></i>
        </a>
    </h1>

    <div class="grid gap-4 lg:grid-cols-3">
        @each('partials.compact-post', $albums, 'post')
    </div>
    
@endsection