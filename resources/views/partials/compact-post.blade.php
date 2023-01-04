<div class="grow lg:basis-1/4 basis-full bg-white border border-gray-200 rounded-lg">
    @if($post->cover_image)
        <img 
            class="rounded-t-lg h-60 w-full object-cover" 
            src="{{ url('storage/files/'.$post->cover_image) }}" 
            alt="Raksta priekšskata attēls" 
        />
    @endif
    <div class="p-5 space-y-3">
        <h5 class="text-2xl font-bold tracking-tight">
            {{ $post->title }}
        </h5>
        <div class="flex flex-wrap justify-between gap-2">
            <div title="Publicēšanas laiks" class="tag bg-gray-100 text-gray-800">
                <i class="fa-solid fa-clock"></i>
                {{ $post->created_at->formatLocalized('%e. %B %Y') }}
            </div>
            <div>
                @if(in_array($post->category, ['new','album']))
                <div title="Komentāri" class="tag bg-blue-100 text-blue-800">
                    <i class="fa-solid fa-comment"></i>
                    {{ $post->comments_count ?? 0 }}
                </div>
                @endif
                @if($post->category == 'album')
                    <div title="Attēli" class="tag bg-blue-100 text-blue-800">
                        <i class="fa-solid fa-image"></i>
                        {{ $post->files_count ?? 0 }}
                    </div>
                @endif
            </div>
        </div>
        <div class="flex"><div class="{{ $post->cover_image ? 'truncate-text' : 'truncate-text-long' }}">
            {!! strip_tags($post->body, '<p><a><b><i><u><s><span>') !!}
        </div></div>
        <a href="{{ route($post->category.'s.show', $post) }}" class="btn-sm">
            Lasīt vairāk
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</div>