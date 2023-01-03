@extends('layouts.app')

@section('body')

    <div class="page-title">
        <h1>Ziņas</h1>
        
        <div class="flex gap-2">
            <x-filters route="{{ route('news.index') }}" />

            @admin
                <a href="{{ route('news.create') }}" class="btn-sm">
                    Izveidot
                </a>
            @endadmin
        </div>
    </div>

    <div class="grid gap-4">
        @each('partials.post', $news, 'post', 'partials.empty')
    </div>

    {{ $news->links() }}
    
@endsection