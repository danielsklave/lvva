@extends('layouts.app')

@section('body')

<h1 class="page-title">
    Komentāri ({{ $comments->count() }})
</h1>

<div class="overflow-x-auto relative sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="py-3 px-6">Autors</th>
                <th class="py-3 px-6">Komentārs</th>
                <th class="py-3 px-6">Laiks</th>
                <th class="py-3 px-6">Darbības</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($comments as $comment)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="py-4 px-6">{{ $comment->user->name }}</td>
                    <td class="py-4 px-6">{{ $comment->body }}</td>
                    <td class="py-4 px-6">{{ $comment->updated_at }}</td>
                    <td class="py-4 px-6 space-y-2">
                        <a href="{{ route('posts.show', $comment->post) }}" class="block font-medium hover:underline">
                            Apskatīt
                        </a>
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                            @csrf @method('DELETE')

                            <button class="font-medium text-red-600 hover:underline" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No post available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $comments->links() }}


@endsection
