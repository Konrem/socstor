<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('meta_title')</title>
    <meta name="google-site-verification" content="Ecr8nIlVPuEtoJAcG2r7wDlCrup4QwhlFh18MmktIWo" />
    <meta name="keywords" content="@yield('meta_keywords')">
    <meta name="description" content="@yield('meta_description')">

    <link href="{{ asset('img/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-migrate-1.4.1.min.js') }}" defer></script>
    <script src="{{ asset('js/slick.min.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/media.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet" type="text/css">
    @stack('style')

</head>
<body>

    <div id="app">
    @include('layouts.check-browser')
        <div class="flex-center position-ref full-height page">
            @include('layouts.menu')
            <div class="content">
                @include('layouts.header')
                <main>
                    @yield('content')
                </main>
                @include('layouts.footer')
            </div>
        </div>
    </div>
    @stack('footer')
</body>
</html>
