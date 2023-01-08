<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('images/LVVA.png') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css')}}">

    <script src="{{ asset('js/flowbite.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</head>

<body>
    <div class="page-bg flex" style="min-height: 100vh;">
        @yield('body')
    </div>
</body>
</html>
