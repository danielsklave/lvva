<!-- Single Comment -->
<div class="rounded-lg border border-gray-200 px-6 py-4">
    <div class="flex justify-between items-center mb-2">
        <div class="flex items-center">
            <p class="inline-flex items-center mr-3 text-gray-800">
                @if($comment->user)
                    {{ $comment->user->name }}
                @else
                    <span class="italic">Dzēsts lietotājs</span>
                @endif
            </p>
            <p class="text-gray-400">
                {{ $comment->created_at->formatLocalized('%d.%m.%Y %R') }}
            </p>
        </div>
        
        @if(auth()->user() && (auth()->user()->is_admin || auth()->id() == $comment->user_id))
            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                @csrf @method('DELETE')
                <button class="delBtn text-red-600 hover:underline" type="submit">Dzēst</button>
            </form>
        @endif
    </div>

    <p>
        {{ $comment->body }}
    </p>
</div>