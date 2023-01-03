<div 
    id="accordion-flush"
    data-accordion="collapse" 
    data-active-classes="bg-white"
>
    @foreach ($postsByYear as $year => $posts)
        <h2 id="accordion-flush-heading-{{ $loop->index }}">
            <button 
                type="button"
                class="flex items-center justify-between w-full py-5 font-medium text-lg text-left border-b border-gray-200"
                data-accordion-target="#accordion-flush-body-{{ $loop->index }}"
                aria-expanded="true" 
                aria-controls="accordion-flush-body-{{ $loop->index }}"
            >

            <span>{{ $year }}</span>

            <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </h2>

        <div 
            id="accordion-flush-body-{{ $loop->index }}"
            class="hidden"
            aria-labelledby="accordion-flush-heading-{{ $loop->index }}"
        >
            <div class="py-5 border-b border-gray-200">
                <ol class="mx-8 relative border-l border-gray-200">                  
                    @foreach ($posts as $post)
                        <li class="mb-6 ml-6">            
                            <span class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white">
                                <svg aria-hidden="true" class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                            </span>

                            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">
                                {{ $post->created_at->format('d.m.Y') }} {{ $post->title }}
                            </h3>

                            <div class="jodit-wysiwyg">
                                {!! $post->body !!}
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    @endforeach
</div>