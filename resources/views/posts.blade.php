@extends('layouts.app')

@section('body')

@php
    $categories = [
        'new' => 'Ziņa',
        'album' => 'Albums',
        'tournament' => 'Sacensība',
        'board_meeting' => 'Valdes sēde',
        'member_meeting' => 'Bierdu sapulce',
        'contest' => 'Konkurss',
    ];
@endphp

<div class="page-title">
    <h1>Raksti ({{ $posts->total() }})</h1>

    <div class="flex gap-2">
        <button data-dropdown-toggle="filter" class="btn-sm" type="button">
            Filtri 
            <svg class="ml-2 w-3 h-3" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </button>

        <div id="filter" class="hidden z-10 bg-white rounded shadow">
            <form class="p-4 space-y-2" action="{{ route('posts.index') }}" method="GET">
                <x-input 
                    label="Virsraksts"
                    name="search"
                    value="{{ Request::get('search') }}"
                />
                <x-select 
                    label="Kategorija"
                    :items="$categories"
                    name="category"
                    value="{{ Request::get('category') }}"
                />
                <x-select 
                    label="Publicēts"
                    name="is_published"
                    value="{{ Request::get('is_published') }}"
                />
                <x-select 
                    label="Aktuāls"
                    name="is_pinned"
                    value="{{ Request::get('is_pinned') }}"
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
                    <a href="{{ route('posts.index') }}" class="btn-sm">
                        Noņemt
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            </form>
        </div>

        <!-- Create post dropdown menu -->
        <button data-dropdown-toggle="create" class="btn-sm" type="button">
            Izveidot 
            <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </button>
        
        <div id="create" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
            <ul class="py-1 text-sm text-gray-700 font-normal">
                @foreach($categories as $key => $category)
                    <li>
                        <a href="{{ route($key.'s.create') }}" class="block py-2 px-4 hover:bg-gray-100">
                            {{ $category }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="overflow-x-auto relative sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="py-3 px-6">Virsraksts</th>
                <th class="py-3 px-6">Saturs</th>
                <th class="py-3 px-6">Kategorija</th>
                <th class="py-3 px-6">Publicēts</th>
                <th class="py-3 px-6">Datums</th>
                <th class="py-3 px-6">Atjaunošanas laiks</th>
                <th class="py-3 px-6">Darbības</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="py-4 px-6">{{ $post->title }}</td>
                    <td class="py-4 px-6">{{ substr(strip_tags($post->body), 0, 60) }}</td>
                    <td class="py-4 px-6">{{ $categories[$post->category] }}</td>
                    <td class="py-4 px-6">{{ $post->published }}</td>
                    <td class="py-4 px-6">{{ $post->created_at->formatLocalized('%d.%m.%Y') }}</td>
                    <td class="py-4 px-6">{{ $post->updated_at->formatLocalized('%d.%m.%Y %R') }}</td>
                    <td class="py-4 px-6 space-y-2">
                        <a href="{{ route($post->category.'s.show', $post) }}" class="block font-medium hover:underline">
                            Apskatīt
                        </a>
                        <a href="{{ route($post->category.'s.edit', $post) }}" class="block font-medium text-blue-600 hover:underline">
                            Rediģēt
                        </a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="delBtn font-medium text-red-600 hover:underline" type="submit">
                                Dzēst
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nekas netika atrasts</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $posts->links() }}

<script>
    document.querySelectorAll('.delBtn').forEach(delBtn =>
        delBtn.addEventListener("click", e =>
            !confirm('Vai tiešām vēlaties rakstu?') && e.preventDefault()
        )
    );
</script>

@endsection
