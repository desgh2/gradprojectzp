<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', '') }}</title> --}}
    <title>КП "Градпроєкт"</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard/portal.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/xs.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/md.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lg.css') }}">
    <link rel="stylesheet" href="{{ asset('css/xl.css') }}"> --}}
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="font-sans antialiased" style="background-color: #16232B">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <a href="/" wire:navigate class="mt-5 mb-4 text-center d-block">
                    <x-application-logo />
                </a>
                @yield('content')
            </div>
        </div>
    </div>
    </div>
</body>

</html>
