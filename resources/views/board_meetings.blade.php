@extends('layouts.app')

@section('body')

    @php
        $valdesDalibnieki = [
            [
                'name' => 'Guntis Zālītis',
                'position' => 'Valdes priekšsēdētājs',
                'phone' => '29456458',
            ],
            [
                'name' => 'Laine Kreicere',
                'position' => 'Valdes priekšsēdētāja vietniece',
                'phone' => '26410552',
            ],
            [
                'name' => 'Dace Brakanska',
                'position' => 'Valdes priekšsēdētāja vietniece',
                'phone' => '29398024',
            ],
            [
                'name' => 'Aiva Jakubovska',
                'position' => 'Valdes locekle',
                'phone' => '22172180',
            ],
            [
                'name' => 'Dace Pilsētniece',
                'position' => 'Valdes locekle',
                'phone' => '26465698',
            ],
            [
                'name' => 'Ināra Fjodorova',
                'position' => 'Valdes locekle',
                'phone' => '26483993',
            ],
            [
                'name' => 'Aivars Puriņš',
                'position' => 'Valdes loceklis',
                'phone' => '26363315',
            ],
        ];
    @endphp

    <div class="page-title">
        <h1>Valde</h1>

        <div class="flex gap-2">
            <x-filters route="{{ route('board_meetings.index') }}" />

            @admin
                <a href="{{ route('board_meetings.create') }}" class="btn-sm">
                    Izveidot
                </a>
            @endadmin
        </div>
    </div>
    
    <div class="flex flex-col-reverse md:flex-row gap-8 md:gap-12 style-links">
        <div class="grow">
            <h1 class="text-2xl font-bold">Valdes sēžu lēmumu protokoli</h1>
            
            <x-year-accordion :postsByYear="$boardMeetingsByYear" />

        </div>
        <div>
            <h1 class="text-2xl font-bold">Valdes dalībnieki</h1>
            <ul class="divide-y divide-gray-200">
                @foreach ($valdesDalibnieki as $item)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="font-bold">{{ $item['name'] }}</p>
                                {{ $item['position'] }}
                            </div>
                            <a href="tel:{{ $item['phone'] }}">{{ $item['phone'] }}</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    
@endsection