
@extends('layouts.app')

@section('body')

<!-- Post Content -->

<div class="page-title">
    @if($contest->id)
        Rediģēt konkursu
    @else
        Izveidot konkursu
    @endif
    @include('partials.back-link')
</div>

<form 
    class="space-y-4" 
    action="{{ $contest->id 
        ? route('contests.update', $contest) 
        : route('contests.store') 
    }}" 
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    @if($contest->id)
        @method('PUT')
    @endif

    <x-input 
        label="Virsraksts" 
        name="title" 
        :value="$contest->title"
        required 
    />

    <x-text-editor 
        label="Saturs"
        name="body"
        :value="$contest->body"
    />

    <x-date-select 
        label="Datums" 
        name="created_at"
        :value="$contest->created_at"
        required
    />

    <x-checkbox
        label="Piesprausts"
        name="is_pinned" 
        :value="$contest->is_pinned"
    />

    <x-checkbox 
        label="Publicēts" 
        name="is_published" 
        :value="$contest->is_published"
    />

    <button class="btn-md" type="submit">
        Saglabāt
    </button>

</form>

@endsection
