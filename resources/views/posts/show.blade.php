@extends('layouts.app')

@section('body')

    <div class="page-title">
        <h1>{{ $post->title }}</h1>

        <div class="flex gap-2">
            @admin
                <a href="{{ route($post->category.'s.edit', $post) }}" class="btn-sm">
                    Rediģēt
                </a>
            @endadmin

            <x-back-link route="{{ route($post->category.'s.index') }}" />
        </div>
    </div>

    <div title="Publicēšanas laiks" class="tag bg-gray-100 text-gray-800">
        <i class="fa-solid fa-clock"></i>
        {!! $post->created_at->formatLocalized('%e. %B %Y') !!}
    </div>

    <div class="jodit-wysiwyg">
        {!! $post->body !!}
    </div>

    @if($post->updated_at != $post->created_at)
        <div class="text-sm text-gray-400">
            Atjaunots: {{ $post->updated_at->formatLocalized('%e. %B %Y %R') }}
        </div>
    @endif

    @if($post->category == 'album')
        <h1 class="text-2xl font-bold">
            Attēli ({{ $post->files->count() }})
        </h1>

        <x-gallery :photos="$post->files" />
    @endif

    <h3 class="text-xl font-bold">
        Komentāri ({{ $post->comments->count() }})
    </h3>

    @auth
        <form 
            class="space-y-4 !mb-8" 
            action="{{ route('posts.comment', $post) }}"
            method="POST"
        >
            @csrf

            <div class="py-2 px-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
                <textarea 
                    class="px-0 w-full text-gray-900 border-0 focus:ring-0 focus:outline-none"
                    placeholder="Komentārs..."
                    name="comment"
                    rows="3"
                ></textarea>
            </div>

            @error('comment')
                <p class="text-red-600" role="alert">
                    {{ $message }}
                </p>
            @enderror

            <button type="submit" class="btn-sm">
                Komentēt
            </button>
        </form>
    @endauth

    @guest
        <div class="text-gray-400">
            Komentārus var publicēt tikai autentificējušies lietotāji.

            <a href="{{ route('login') }}" class="text-sky-600 hover:underline">
                Autentificēties
            </a>
        </div>
    @endguest

    @if($post->comments->isNotEmpty()) 
        <div class="space-y-4">
            @each('partials.comment', $post->comments, 'comment', 'partials.empty')
        </div>
    @endif

    <script>
        document.querySelectorAll('.delBtn').forEach(delBtn =>
            delBtn.addEventListener("click", e =>
                !confirm('Vai tiešām vēlaties dzēst komentāru?') && e.preventDefault()
            )
        );
</script>

@endsection