@extends('layouts.app')

@section('body')

@php
    $title = [
        'new' => 'ziņu',
        'album' => 'albumu',
        'board_meeting' => 'valdes sēdi',
        'member_meeting' => 'biedru sapulci',
        'contest' => 'konkursu',
        'tournament' => 'sacensību',
    ][$post->category] ?? 'ierakstu';
@endphp

<div class="page-title">
    <h1>
        @if($post->id)
            Rediģēt {{ $title }}
        @else
            Izveidot {{ $title }}
        @endif
    </h1>
    
    <div class="flex gap-2">
        @if($post->id)
            <form 
                action="{{ route($post->category.'s.destroy', $post)  }}" 
                method="POST"
            >
                @csrf @method('DELETE')

                <button class="delBtn btn-sm" type="submit">
                    Dzēst
                </button>
            </form>
        @endif

        <x-back-link />
    </div>
</div>

<form 
    class="space-y-4" 
    action="{{ $post->id 
        ? route($post->category.'s.update', $post) 
        : route($post->category.'s.store') 
    }}" 
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    @if($post->id)
        @method('PUT')
    @endif

    <x-input 
        label="Virsraksts" 
        name="title" 
        :value="$post->title"
        required 
    />

    @if(in_array($post->category, ['new', 'album']))
        <x-file-select 
            label="Priekšskata attēls" 
            name="cover_image"
            :value="$post->cover_image"
            image
        />
    @endif

    <x-text-editor 
        label="Saturs"
        name="body"
        :value="$post->body"
    />

    @if($post->category == 'album')
        <x-file-select 
            label="Albuma attēli" 
            name="files"
            :value="$post->files"
            image
            multiple
        />
    @endif

    <x-date-select 
        label="Datums" 
        name="created_at"
        :value="$post->created_at"
        required
    />

    <x-checkbox
        label="Aktuāls"
        name="is_pinned" 
        :value="$post->is_pinned"
    />

    <x-checkbox 
        label="Publicēts" 
        name="is_published" 
        :value="$post->is_published" 
    />

    <button class="btn-md" type="submit">
        Saglabāt
    </button>

</form>

<script>
    document.querySelectorAll('.delBtn').forEach(delBtn =>
        delBtn.addEventListener("click", e =>
            !confirm('Vai tiešām vēlaties dzēst {{ $title }}?') && e.preventDefault()
        )
    );
</script>

@endsection
