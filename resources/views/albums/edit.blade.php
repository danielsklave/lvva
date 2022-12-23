
@extends('layouts.app')

@section('body')

<!-- Post Content -->

<div class="page-title">
    @if($album->id)
        Rediģēt albumu
    @else
        Izveidot albumu
    @endif
    @include('partials.back-link')
</div>

<form 
    class="space-y-4" 
    action="{{ $album->id 
        ? route('albums.update', $album) 
        : route('albums.store') 
    }}" 
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    @if($album->id)
        @method('PUT')
    @endif

    <x-input 
        label="Virsraksts" 
        name="title" 
        :value="$album->title"
        required 
    />

    <x-file-select 
        label="Priekšskata attēls" 
        name="cover_image"
        :value="$album->cover_image"
    />

    <x-text-editor 
        label="Saturs"
        name="body"
        :value="$album->body"
    />

    <x-file-select 
        label="Albuma attēli" 
        name="images"
        :value="$album->files"
        multiple
    />

    <x-date-select 
        label="Datums" 
        name="created_at"
        :value="$album->created_at"
        required
    />

    <x-checkbox
        label="Piesprausts"
        name="is_pinned" 
        :value="$album->is_pinned"
    />

    <x-checkbox 
        label="Publicēts" 
        name="is_published" 
        :value="$album->is_published" 
    />

    <button class="btn-md" type="submit">
        Saglabāt
    </button>

</form>

@endsection
