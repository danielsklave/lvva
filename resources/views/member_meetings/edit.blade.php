
@extends('layouts.app')

@section('body')

<!-- Post Content -->

<div class="page-title">
    @if($member_meeting->id)
        Rediģēt sacensību
    @else
        Izveidot sacensību
    @endif
    @include('partials.back-link')
</div>

<form 
    class="space-y-4" 
    action="{{ $member_meeting->id 
        ? route('member_meetings.update', $member_meeting) 
        : route('member_meetings.store') 
    }}" 
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    @if($member_meeting->id)
        @method('PUT')
    @endif

    <x-input 
        label="Virsraksts" 
        name="title" 
        :value="$member_meeting->title"
        required 
    />

    <x-text-editor 
        label="Saturs"
        name="body"
        :value="$member_meeting->body"
    />

    <x-date-select 
        label="Datums" 
        name="created_at"
        :value="$member_meeting->created_at"
        required
    />

    <x-checkbox
        label="Piesprausts"
        name="is_pinned" 
        :value="$member_meeting->is_pinned"
    />

    <x-checkbox 
        label="Publicēts" 
        name="is_published" 
        :value="$member_meeting->is_published"
    />

    <button class="btn-md" type="submit">
        Saglabāt
    </button>

</form>

@endsection
