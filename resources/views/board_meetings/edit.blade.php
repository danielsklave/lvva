
@extends('layouts.app')

@section('body')

<!-- Post Content -->

<div class="page-title">
    @if($board_meeting->id)
        Rediģēt sacensību
    @else
        Izveidot sacensību
    @endif
    @include('partials.back-link')
</div>

<form 
    class="space-y-4" 
    action="{{ $board_meeting->id 
        ? route('board_meetings.update', $board_meeting) 
        : route('board_meetings.store') 
    }}" 
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    @if($board_meeting->id)
        @method('PUT')
    @endif

    <x-input 
        label="Virsraksts" 
        name="title" 
        :value="$board_meeting->title"
        required 
    />

    <x-text-editor 
        label="Saturs"
        name="body"
        :value="$board_meeting->body"
    />

    <x-date-select 
        label="Datums" 
        name="created_at"
        :value="$board_meeting->created_at"
        required
    />

    <x-checkbox
        label="Piesprausts"
        name="is_pinned" 
        :value="$board_meeting->is_pinned"
    />

    <x-checkbox 
        label="Publicēts" 
        name="is_published" 
        :value="$board_meeting->is_published"
    />

    <button class="btn-md" type="submit">
        Saglabāt
    </button>

</form>

@endsection
