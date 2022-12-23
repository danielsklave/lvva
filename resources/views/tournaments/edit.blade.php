
@extends('layouts.app')

@section('body')

<!-- Post Content -->

<div class="page-title">
    @if($tournament->id)
        Rediģēt sacensību
    @else
        Izveidot sacensību
    @endif
    @include('partials.back-link')
</div>

<form 
    class="space-y-4" 
    action="{{ $tournament->id 
        ? route('tournaments.update', $tournament) 
        : route('tournaments.store') 
    }}" 
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    @if($tournament->id)
        @method('PUT')
    @endif

    <x-input 
        label="Virsraksts" 
        name="title" 
        :value="$tournament->title"
        required 
    />

    <x-text-editor 
        label="Saturs"
        name="body"
        :value="$tournament->body"
    />

    <x-date-select 
        label="Datums" 
        name="created_at"
        :value="$tournament->created_at"
        required
    />

    <x-checkbox
        label="Piesprausts"
        name="is_pinned" 
        :value="$tournament->is_pinned"
    />

    <x-checkbox 
        label="Publicēts" 
        name="is_published" 
        :value="$tournament->is_published" 
    />

    <button class="btn-md" type="submit">
        Saglabāt
    </button>

</form>

@endsection
