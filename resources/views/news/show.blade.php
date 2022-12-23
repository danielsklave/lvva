@extends('layouts.app')

@section('body')

<!-- Title -->
<h1 class="page-title">
    {{ $news->title }}
    <a href="{{ route('news.edit', $news) }}" class="btn-sm">Rediģēt</a>
</h1>

<!-- Date/Time -->
<div title="Publicēšanas laiks" class="gap-2 w-fit bg-gray-100 text-gray-800 text-sm font-medium inline-flex items-center px-2.5 py-1 rounded">
    <i class="fa-solid fa-clock"></i>
    {{ $news->created_at->formatLocalized('%e. %B %Y %R') }}
</div>

<!-- New Content -->
<div class="fr-view">
    {!! $news->body !!}
</div>

@if($news->updated_at != $news->created_at)
    <div class="text-sm text-gray-400">
        Atjaunots: {{ $news->updated_at->formatLocalized('%e. %B %Y %R') }}
    </div>
@endif

<h3 class="text-xl font-bold">Komentāri ({{ $news->comments->count() }})</h3>
<!-- Comments Form -->
@auth @include('partials.comment-form') @endauth

@if($news->comments->isNotEmpty()) 
<div class="space-y-4">
    @each('partials.comment', $news->comments, 'comment')
</div>
@endif

@endsection
