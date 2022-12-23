<form class="space-y-4 !mb-8" action="{{ route('posts.comment', ['post' => $news]) }}" method="POST">
    @csrf

    <div class="py-2 px-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
        <textarea placeholder="Komentārs..." class="px-0 w-full text-gray-900 border-0 focus:ring-0 focus:outline-none" name="body" rows="3"></textarea>
    </div>

    <button type="submit" class="btn-sm">
        Komentēt
    </button>
</form>