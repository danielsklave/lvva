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


<!-- TODO: get all count -->
<h1 class="page-title">
    Saturs ({{ $posts->count() }})
    <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="btn-sm" type="button">
        Izveidot 
        <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
    </button>
    <!-- Dropdown menu -->
    <div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
        <ul class="py-1 text-sm text-gray-700 font-normal" aria-labelledby="dropdownDefault">
            @foreach($categories as $key => $category)
                <li>
                    <a href="{{ route($key.'s.create') }}" class="block py-2 px-4 hover:bg-gray-100">
                        {{ $category }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</h1>
    

<div class="overflow-x-auto relative sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="py-3 px-6">Virsraksts</th>
                <th class="py-3 px-6">Saturs</th>
                <th class="py-3 px-6">Kategorija</th>
                <th class="py-3 px-6">Publicēts</th>
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
                    <td class="py-4 px-6">{{ $post->updated_at }}</td>
                    <td class="py-4 px-6 space-y-2">
                        <a href="{{ route('posts.show', $post) }}" class="block font-medium hover:underline">Apskatīt</a>
                        <a href="{{ route($post->category.'s.edit', $post) }}" class="block font-medium text-blue-600 hover:underline">Rediģēt</a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf @method('DELETE')

                            <button class="font-medium text-red-600 hover:underline" type="submit">Dzēst</button>
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

{{ $posts->links() }}


@endsection
