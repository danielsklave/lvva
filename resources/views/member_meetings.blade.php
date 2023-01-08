@extends('layouts.app')

@section('body')
    
    <div class="page-title">
        <h1>Biedru sapulces</h1>

        <div class="flex gap-2">
            <x-filters route="{{ route('member_meetings.index') }}" />

            @admin
                <a href="{{ route('member_meetings.create') }}" class="btn-sm">
                    Izveidot
                </a>
            @endadmin
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-8 md:gap-12">
        <div class="md:w-3/4">
            <h1 class="text-2xl font-bold">Sapulču protokoli</h1>

            <x-year-accordion :postsByYear="$memberMeetingsByYear" />

        </div>

        <div class="space-y-4 style-links">
            <h1 class="text-2xl font-bold">
                LVVA pārskati
            </h1>

            <div class="flex flex-col w-fit">
                <a href="{{ url('files/lvva_parskats_2021.pdf') }}" target="_blank">
                    LVVA pārskats 2021
                </a>
                <a href="{{ url('files/lvva_parskats_2020.pdf') }}" target="_blank">
                    LVVA pārskats 2020
                </a>
                <a href="{{ url('files/lvva_parskats_2019.pdf') }}" target="_blank">
                    LVVA pārskats 2019
                </a>
                <a href="{{ url('files/lvva_parskats_2018.pdf') }}" target="_blank">
                    LVVA pārskats 2018
                </a>
                <a href="{{ url('files/lvva_parskats_2017.pdf') }}" target="_blank">
                    LVVA pārskats 2017
                </a>
                <a href="{{ url('files/lvva_parskats_2016.doc') }}" target="_blank">
                    LVVA pārskats 2016
                </a>
                <a href="{{ url('files/lvva_parskats_2015.doc') }}" target="_blank">
                    LVVA pārskats 2015
                </a>
                <a href="{{ url('files/lvva_parskats_2014.doc') }}" target="_blank">
                    LVVA pārskats 2014
                </a>
            </div>

            <br/>

            <h1 class="text-2xl font-bold">
                Revidenta ziņojumi
            </h1>

            <div class="flex flex-col w-fit">
                <a href="{{ url('files/revidenta_zinojums_2021.pdf') }}" target="_blank">
                    Revidenta ziņojums 2021
                </a>
                <a href="{{ url('files/revidenta_zinojums_2020.pdf') }}" target="_blank">
                    Revidenta ziņojums 2020
                </a>
                <a href="{{ url('files/revidenta_zinojums_2019.pdf') }}" target="_blank">
                    Revidenta ziņojums 2019
                </a>
                <a href="{{ url('files/revidenta_zinojums_2018.pdf') }}" target="_blank">
                    Revidenta ziņojums 2018
                </a>
                <a href="{{ url('files/revidenta_zinojums_2016.docx') }}" target="_blank">
                    Revidenta ziņojums 2016
                </a>
            </div>
        </div>
    </div>
    
@endsection