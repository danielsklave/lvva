@extends('layouts.app')

@section('body')

    @php
        $arr = [
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
        ]
    @endphp

    <h1 class="text-3xl font-bold">Valde</h1>

    <ul class="max-w-md divide-y divide-gray-200">
        @foreach ($arr as $item)
            <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-1 min-w-0">
                        <p class="font-bold">{{ $item['name'] }}</p>
                        {{ $item['position'] }}
                    </div>
                    <a href="tel:{{ $item['phone'] }}" class="hover:underline">{{ $item['phone'] }}</a>
                </div>
            </li>
        @endforeach
    </ul>
    
    <h1 class="text-2xl font-bold">Sēžu lēmumu protokoli</h1>

    <div>

    </div>
    
@endsection