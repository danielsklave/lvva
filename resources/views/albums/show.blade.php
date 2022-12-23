@extends('layouts.app')

@section('body')

    <h1 class="page-title">
        {{ $album->title }}
        <a href="{{ route('albums.edit', $album) }}" class="btn-sm">Rediģēt</a>
    </h1>

    <div>
        {!! $album->body !!}
    </div>

    @if($album->updated_at != $album->created_at)
        <div class="text-sm text-gray-400">
            Atjaunots: {{ $album->updated_at->formatLocalized('%e. %B %Y %R') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold">Attēli ({{ $album->files->count() }})</h1>

    <div id="lightgallery" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-4">
        @foreach ($album->files as $photo)
            <a class="w-full h-60" href="{{ url('storage/files/'.$photo->file_name) }}">
                <img class="h-full w-full object-cover object-center" src="{{ url('storage/files/'.$photo->file_name) }}" />
            </a>
        @endforeach
    </div>
    <script src="{{ asset('js/app.js')}}"></script>
    <script>
        lightGallery(document.getElementById("lightgallery"), {
            animateThumb: false,
            flipHorizontal: false,
            flipVertical: false,
            rotateLeft: false,
            plugins: [
                lgZoom,
                lgThumbnail,
                lgFullscreen,
                lgShare,
                lgRotate,
                lgAutoplay,
            ],
            mobileSettings: {
                controls: false,
                showCloseIcon: false,
                download: false,
                rotate: false
            }
        });
    </script>
@endsection