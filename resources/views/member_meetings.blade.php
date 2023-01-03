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

    <div class="flex flex-col md:flex-row gap-8 md:gap-12 style-links">
        <div class="grow">
            <h1 class="text-2xl font-bold">Sapulču protokoli</h1>

            <x-year-accordion :postsByYear="$memberMeetingsByYear" />

        </div>

        <div class="space-y-4">
            <h1 class="text-2xl font-bold">LVVA pārskati</h1>
            <div class="flex flex-col w-fit">
            </div>
            <br/>
            <h1 class="text-2xl font-bold">Rividenta ziņojumi</h1>
            <div class="flex flex-col w-fit">
            </div>
        </div>
    </div>
    
@endsection