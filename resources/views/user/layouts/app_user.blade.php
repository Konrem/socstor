<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Відділ соціальної роботи</title>

    <link href="{{ asset('img/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
    <!--Script for CKEditor-->
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}" defer></script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Font Awesome -->
    <script src="{{ asset('js/all.min.js') }}"> </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/media.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    
    @stack('style')

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                Відділ соціальної роботи
            </a>
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="far fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item pl-3" href="{{ route('user.logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <i class="fas fa-sign-out-alt mr-1"></i>
                                                    Вийти
                            </a>

                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
    </nav>
    <div id="app" class="user">
        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-2 user-sidebar shadow-sm">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
               <!--              <div class="btn-group"> -->
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="user-list">
                                            <li >
                                                <a class="btn {{ (request()->is('user')) ? 'active' : ''  }}"
                                                    href="{{route('user.index')}}">
                                                    <i class="fas fa-chart-line"></i> Початкова сторінка
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn {{ (request()->is('user/news*')) ? 'active' : ''  }}"
                                                    href="{{route('user.news.index')}}">
                                                    <i class="far fa-newspaper"></i> Новини
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn {{ (request()->is('user/slider*')) ? 'active' : ''  }}"
                                                    href="{{route('user.slider.index')}}">
                                                    <i class="far fa-image"></i> Слайдер
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn {{ (request()->is('user/partners*')) ? 'active' : ''  }}"
                                                    href="{{route('user.partners.index')}}">
                                                    <i class="far fa-image"></i> Слайдер з партнерами
                                                </a>
                                            </li>
                                            <li >
                                                <a class="btn 
                                                    {{ (request()->is('user/photo-gallery*')) ? 'active' : ''  }}"
                                                    href="{{route('user.photo-gallery.index')}}">
                                                    <i class="far fa-image"></i> Альбоми
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn {{ (request()->is('user/select-photo*')) ? 'active' : '' }}"
                                                    href="{{ route('user.select-photo.index') }}">
                                                    <i class="fas far fa-image"></i> Фото Соціальної служби<span class="sr-only">(current)</span>
                                                </a>
                                            </li>
                                            <li >
                                                <a class="btn {{ (request()->is('user/blocks*')) ? 'active' : ''  }}" 
                                                    href="{{ route('user.blocks.index') }}">
                                                    <i class="fas fa-info-circle"></i> Інформаційні блоки <span class="sr-only">(current)</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn {{ (request()->is('user/pages*')) ? 'active' : ''  }}" 
                                                    href="{{ route('user.pages.index') }}">
                                                    <i class="far fa-file-alt"></i> Сторінки<span class="sr-only">(current)</span></a>
                                            </li>
                                            <li>
                                                <a class="btn {{ (request()->is('user/emploee*')) ? 'active' : '' }}"
                                                    href="{{ route('user.emploee.index') }}">
                                                    <i class="fas fa-user-friends"></i> Працівники<span class="sr-only">(current)</span>
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8 col-lg-10 pt-4 mx-auto">
                        @yield('content')
                    </div>
                </div>

            </div>
        </main>
    </div>
    @stack('down')
</body>
</html>
