@extends('layouts.app')

@section('body')

    @php
        $categories = [
            'new' => 'Ziņas',
            'album' => 'Albumi',
            'tournament' => 'Sacensības',
            'board_meeting' => 'Valdes sēdes',
            'member_meeting' => 'Bierdu sapulces',
            'contest' => 'Konkursi',
        ];
    @endphp

    @if($pins->isNotEmpty())
        <div class="page-title">
            <h1>Aktualitātes</h1>
        </div>

        <div class="flex flex-wrap gap-4">
            @each('partials.compact-post', $pins, 'post')
        </div>
    @endif

    @foreach($categories as $name => $title)
        @if($postsByCategory[$name])
            <div class="page-title">
                <h1>{{ $title }}</h1>

                <a href="{{ route($name.'s.index') }}" class="style-links text-base gap-2">
                    {{ $title }} 
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="flex flex-wrap gap-4">
                @each('partials.compact-post', $postsByCategory[$name], 'post')
            </div>
        @endif
    @endforeach

@endsection