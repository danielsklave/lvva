@extends('layouts.app')

@section('body')

<div class="page-title">
    <h1>Komentāri ({{ $comments->total() }})</h1>

    <button id="dropdownSmallButton" data-dropdown-toggle="dropdownSmall" class="btn-sm" type="button">
        Filtri 
        <svg class="ml-2 w-3 h-3" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
    </button>

    <div id="dropdownSmall" class="hidden z-10 bg-white rounded shadow">
        <form class="p-4 space-y-2" action="{{ route('comments.index') }}" method="GET">
            <x-input 
                label="Autors"
                name="author"
                value="{{ Request::get('author') }}"
            />
            <x-input 
                label="Komentārs"
                name="search"
                value="{{ Request::get('search') }}"
            />
            <x-date-select
                label="Datums no"
                name="date_from"
                value="{{ Request::get('date_from') ?: ' ' }}"
            />
            <x-date-select
                label="Datums līdz"
                name="date_to"
                value="{{ Request::get('date_to') ?: ' ' }}"
            />
            <div class="flex gap-2 !mt-4">
                <button type="submit" class="btn-sm">
                    Meklēt 
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <a href="{{ route('comments.index') }}" class="btn-sm">
                    Noņemt
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
        </form>
    </div>
</div>

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
                @if($comment->post)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="py-4 px-6">{{ $comment->user->name }}</td>
                        <td class="py-4 px-6">{{ $comment->body }}</td>
                        <td class="py-4 px-6">{{ $comment->created_at->formatLocalized('%d.%m.%Y %R') }}</td>
                        <td class="py-4 px-6 space-y-2">
                            <a href="{{ route($comment->post->category.'s.show', $comment->post) }}" class="block font-medium hover:underline">
                                Apskatīt
                            </a>
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="delBtn font-medium text-red-600 hover:underline" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="6">Nekas netika atrasts</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $comments->links() }}

<script>
    document.querySelectorAll('.delBtn').forEach(delBtn =>
        delBtn.addEventListener("click", e =>
            !confirm('Vai tiešām vēlaties dzēst komentāru?') && e.preventDefault()
        )
    );
</script>

@endsection
