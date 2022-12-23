<!-- Single Comment -->
<div class="rounded-lg border border-gray-200 px-6 py-4">
    <div class="flex justify-between items-center mb-2">
        <div class="flex items-center">
            <p class="inline-flex items-center mr-3 text-gray-800">{{ $comment->user->name }}</p>
            <p class="text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <p>
        {{ $comment->body }}
    </p>
</div>