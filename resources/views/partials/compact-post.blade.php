<div class="bg-white border border-gray-200 rounded-lg">
    @if($post->cover_image)
        <a href="{{ $post->path() }}">
            <img class="rounded-t-lg h-60 w-full object-cover" src="{{ url('storage/files/'.$post->cover_image) }}" alt="" />
        </a>
    @endif
    <div class="p-5 space-y-3">
        <a href="#">
            <h5 class="text-2xl font-bold tracking-tight">
                {{ $post->title }}
            </h5>
        </a>
        <div class="flex flex-wrap justify-between gap-2">
            <div title="Publicēšanas laiks" class="gap-2 w-fit bg-gray-100 text-gray-800 text-sm font-medium inline-flex items-center px-2.5 py-1 rounded">
                <i class="fa-solid fa-clock"></i>
                {{ $post->created_at->formatLocalized('%e. %B %Y') }}
            </div>
            <div>
                <div title="Komentāri" class="gap-2 w-fit bg-blue-100 text-blue-800 text-sm font-medium inline-flex items-center px-2.5 py-1 rounded">
                    <i class="fa-solid fa-comment"></i>
                    {{ $post->comments_count ?? 0 }}
                </div>
                @if($post->category == 'album')
                    <div title="Attēli" class="gap-2 w-fit bg-blue-100 text-blue-800 text-sm font-medium inline-flex items-center px-2.5 py-1 rounded">
                        <i class="fa-solid fa-image"></i>
                        {{ $post->files_count ?? 0 }}
                    </div>
                @endif
            </div>
        </div>
        <div class="flex"><div class="{{ $post->cover_image ? 'truncate-text' : 'truncate-text-long' }} fr-view">
            {!! $post->body !!}
        </div></div>
        <a href="{{ $post->path() }}" class="btn-sm">
            Lasīt vairāk
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</div>