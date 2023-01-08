<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('images/LVVA.png') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css')}}" />

    <script src="{{ asset('js/flowbite.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</head>
<body>
    <div class="page-bg">
        <div class="container mx-auto" style="min-height: 60vh;">
            @include('includes.navbar')

            <div class="page-body bg-white p-6 space-y-4">
                @yield('body')
            </div>
        </div>
    </div>
    @include('includes.footer')
</body>
</html>
