<!doctype html>
<html class="{{ $theme }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ app()->getLocale() == 'fa' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Include Bootstrap CSS -->
    @if (app()->getLocale() == 'fa')
        <link rel="stylesheet" href="{{ asset('lib/bootstrap-5.3.3-dist/css/bootstrap.rtl.min.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('lib/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    @endif

    <!-- Include custom stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @if (app()->getLocale() == 'fa')
        <link rel="stylesheet" href="{{ asset('css/rtl-style.css') }}">
    @endif

    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('/lib/fontawesome-free-6.4.2-web/css/all.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

</head>

<body>
    <div id="app">

        @if ($showNav === "true")
            <x-navigation />
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Include Bootstrap JavaScript -->
    <script src="{{ asset('lib/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
