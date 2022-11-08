<!-- Blog Post -->
<div class="p-6 rounded-lg border border-gray-200 space-y-4">
    <a href="{{ $post->path() }}">
        <h5 class="text-2xl font-bold tracking-tigh">
            {{ $post->title }}    
        </h5>
    </a>
    <div class="flex md:flex-row flex-col justify-between gap-2">
        <div title="Publicēšanas laiks" class="w-fit bg-gray-100 text-gray-800 text-sm font-medium inline-flex items-center px-2.5 py-1 rounded">
            <svg aria-hidden="true" class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
            {{ $post->created_at->toDayDateTimeString() }}
        </div>
        <div title="Komentāri" class="w-fit bg-blue-100 text-blue-800 text-sm font-medium inline-flex items-center px-2.5 py-1 rounded">
            <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            {{ $post->comments_count }}
        </div>
    </div>
    <div class="flex"><div class="truncate2">{!! strip_tags($post->body, ['b', 'a', 'u', 'br']) !!}</div></div>
    <a href="{{ $post->path() }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-sky-700 rounded-lg hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
        Lasīt vairāk
        <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </a>
</div>
