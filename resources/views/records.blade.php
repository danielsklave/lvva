@extends('layouts.app')

@section('body')

    <div class="page-title">
        <h1>Rekordi</h1>
    </div>

    <div class="flex flex-col style-links">
        <a class="w-fit" href="{{ url('files/LVVA Latvijas veterānu rekordi vieglatlētikā (11 2021) VĪRIEŠI.pdf') }}" target="_blank">
            Latvijas veterānu rekordi vieglatlētikā vīriešiem (uz 01.11.2021)
        </a>
        <a class="w-fit" href="{{ url('files/LVVA Latvijas veterānu rekordi vieglatlētikā (11 2021) SIEVIETES.pdf') }}" target="_blank">
            Latvijas veterānu rekordi vieglatlētikā sievietēm (uz 01.11.2021)
        </a>
        <br />
        <a class="w-fit" href="https://european-masters-athletics.org/records-statistics" target="_blank">
            Eiropas veterānu rekordi vieglatlētikā
        </a>
        <a class="w-fit" href="https://world-masters-athletics.com/records/" target="_blank">
            Pasaules veterānu rekordi vieglatlētikā
        </a>
        <br />
        <a class="w-fit" href="https://mastersrankings.com/" target="_blank">
            World Masters ranking - Pasaules veterānu rezultātu vieglatlētikā datu bāze
        </a>
        <a class="w-fit" href="https://www.worldathletics.org/news/news/scoring-tables-2022" target="_blank">
            IAAF SCORING TABLES OF ATHLETICS (2022)
        </a>
        <a class="w-fit" href="{{ url('files/2020-2022-WMA-RULES-OF-COMPETITION-as-20-November-2020.pdf') }}" target="_blank">
            WMA Vecuma koeficienti un sacesnību noteikumi
        </a>
        
    </div>

@endsection