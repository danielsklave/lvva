@extends('layouts.app')

@section('body')

<!-- New Content -->

<div class="page-title">
    @if($news->id)
        Rediģēt ziņu
    @else
        Izveidot ziņu
    @endif
    @include('partials.back-link')
</div>

<form 
    class="space-y-4" 
    action="{{ $news->id 
        ? route('news.update', $news) 
        : route('news.store') 
    }}" 
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    @if($news->id)
        @method('PUT')
    @endif

    <x-input 
        label="Virsraksts" 
        name="title" 
        :value="$news->title"
        required 
    />

    <x-file-select 
        label="Priekšskata attēls" 
        name="cover_image"
        :value="$news->cover_image"
    />

    <x-text-editor 
        label="Saturs"
        name="body"
        :value="$news->body"
        required
    />

    <x-date-select 
        label="Datums" 
        name="created_at"
        :value="$news->created_at"
        required
    />

    <x-checkbox
        label="Piesprausts"
        name="is_pinned" 
        :value="$news->is_pinned"
    />

    <x-checkbox 
        label="Publicēts" 
        name="is_published" 
        :value="$news->is_published" 
    />

    <button class="btn-md" type="submit">
        Saglabāt
    </button>

</form>

@endsection
