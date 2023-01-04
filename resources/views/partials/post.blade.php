<div class="bg-white rounded-lg overflow-hidden border border-gray-200">
    <div class="md:flex">
        @if($post->cover_image)
            <div class="md:shrink-0">
                <img 
                    class="h-48 w-full object-cover md:h-full md:!w-60"
                    src="{{ url('storage/files/'.$post->cover_image) }}"
                    alt="Raksta priekšskata attēls"
                />
            </div>
        @endif
        <div class="p-6 space-y-4 w-full">
            <h5 class="text-2xl font-bold tracking-tigh">
                {{ $post->title }}    
            </h5>
            <div class="flex flex-wrap justify-between gap-2">
                <div title="Publicēšanas laiks" class="tag bg-gray-100 text-gray-800">
                    <i class="fa-solid fa-clock"></i>
                    {{ $post->created_at->formatLocalized('%e. %B %Y') }}
                </div>
                <div>
                    <div title="Komentāri" class="tag bg-blue-100 text-blue-800">
                        <i class="fa-solid fa-comment"></i>
                        {{ $post->comments_count ?? 0 }}
                    </div>
                    @if($post->category == 'album')
                    <div title="Attēli" class="tag bg-blue-100 text-blue-800">
                        <i class="fa-solid fa-image"></i>
                        {{ $post->files_count ?? 0 }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="flex"><div class="truncate-text">
                {!! strip_tags($post->body, '<p><a><b><i><u><s><span>') !!}
            </div></div>
            <a href="{{ route($post->category.'s.show', $post) }}" class="btn-sm">
                Lasīt vairāk
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
