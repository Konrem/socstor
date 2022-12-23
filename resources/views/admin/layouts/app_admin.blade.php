<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title')</title>
    <link href="{{ asset('img/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
        crossorigin="anonymous"
    >

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Відділ соціальної роботи</a>
 <!--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="far fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item pl-3" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-1"></i>
                            Вийти
                    </a>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="GET" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
    </nav>

    <div id="app" class="admin">
        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4 col-md-3 col-xl-2 admin-sidebar">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav admin-list">
                                <li class="nav-item">
                                    <a class="btn {{ (request()->is('admin')) ? 'active' : ''  }}" href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-line"></i> Панель адміністратора </a>
                                </li>
                            <!-- Users -->
                                <li class="nav-item">
                                    <input type="checkbox" id="btnControl" {{ ((request()->is('admin/user-management/users*')) || (request()->is('admin/user-management/admins*'))) ? 'checked' : '' }} />
                                    <label for="btnControl"  class="btn dropdown-toggle" >
                                        <i class="fas fa-user-friends"></i> Користувачі
                                    </label>
                                    <div class="dropdown" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item {{ (request()->is('admin/user-management/users*')) ? 'active' : '' }}" href="{{ route('admin.user-management.users.index') }}"><i class="fas fa-user"></i> Контент менеджери</a>
                                        <a class="dropdown-item {{ (request()->is('admin/user-management/admins*')) ? 'active' : '' }}" href="{{ route('admin.user-management.admins.index') }}"><i class="fas fa-user-secret"></i> Адмністратори</a>
                                    </div>
                                </li>
                                <li class="nav-item ">
                                    <a class="btn {{ (request()->is('admin/configs*')) ? 'active' : '' }}" href="{{ route('admin.configs.index') }}"><i class="fas fa-cogs"></i> Конфігурація</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-8 col-md-9 col-xl-10 pt-4">
                        @yield('content')
                    </div>
                </div>
            </div>         
        </main>
    </div>
</body>
@stack('down_adm')
</html>
