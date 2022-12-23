<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $news->title . ' - ' . $appName }}</title>
    <meta name="keywords" content="{{ $news->meta_keywords ?? '' }}">
    <meta name="description" content="{{ $news->meta_description ?? '' }}">
    
    <link href="{{ asset('img/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-migrate-1.4.1.min.js') }}" defer></script>
    <script src="{{ asset('js/slick.min.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/media.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">
    <div class="flex-center position-ref full-height page page-cur-new">
        <div class="current-page-content">
                <a href="{{ URL::previous() }}" class="btn-back"><img src="/img/reply.svg" alt=""><div class="back-text">Повернутися</div></a>                
            <main class="c_news">
                <div class="page-title">
                    <span>{{ $news->title ?? "" }}</span>
                </div>
                <div class="slider">
                    <div class="photo-part">
                        <div class="slider-for">
                            {{-- <img src="{{ $news->getPath() }}" alt="" class="img-fluid"> --}}
                                @foreach ($anotherPhotos as $photos) 
                                <div>
                                    <img src="{{ asset('/storage/' . $photos['photo'] ) }}" class="img-fluid" alt="">
                                </div>
                                @endforeach
                        </div>
                    </div>
                     @if(count($anotherPhotos)>1)
                     <div class="slider-navigation">
                         <div class="slider-in-photo">
                            <div class="slider-nav">
                                {{-- <div class="item"><img src="{{ $news->getPath() }}" alt="" class="img-fluid" ></div> --}}
                                    @foreach ($anotherPhotos as $photos)
                                        <div class="item">
                                            <img src="{{ asset('/storage/' . $photos['photo'] )}}" alt="">
                                        </div>
                                    @endforeach   
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
               
                <div class="news-content">{!! $news->text !!}</div>
                <div class="news-date">Дата: {{ $news->fullDate() }}</div>
            </main>

        </div>
    </div>
</div>

<script src="{{ asset('js/news-carusel.js') }}" defer></script>
</body>
</html>