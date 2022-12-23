@extends('layouts.app')

@section('meta_title', 'Результати пошуку')

@section('content')
    <div class="page-title">
        <span>Результати пошуку</span>
    </div>

    <div class="news">
        @if ($search_result[1] !== null && $search_result[1] !== "01.01.1970")
            <p class="news-text">Дата запиту з: {{ $search_result[1] }}</p>
        @endif
        @if ($search_result[2] !== null && $search_result[2] !== "01.01.1970")
            <p class="news-text">Дата запиту по: {{ $search_result[2] }}</p>
        @endif
        @if ($search_result[0] !== null)
            <p class="news-text"><br>Пошук за назвою: {{ $search_result[0] }}</p>
        @endif

        <a href="/news">Повернутись до попередньої сторінки</a>

        @forelse($article as $news)
        <hr>
        <div class="news-item">
            <div class="date">
                <span class="month">
                    {{ $news->getMonth() }}
                </span>
                <hr>
                <span class="day">
                    {{ $news->getDay() }}
                </span>
            </div>
            <div class="news-image">
            <img src={{ $news->getPath() }} alt="{{ $news->title }}">
            </div>
            <div class="news-body">
                <div class="news-name">
                    {{ $news->title }}
                </div>
                <div class="news-text">
                    {{ $news->description() }}
                </div>
                <hr>
                <div class="show-next">
                    <a href="{{  'news/' . $news->slug }}">
                        Читати повністю
                        <img src="img/right-arrow(1).svg" alt="">
                    </a>
                </div>
            </div>
        </div>
        @empty
            <h2 class="text-center">Нажаль нічого не знайдено за вашими критеріями</h2>
        @endforelse
        <div class="d-flex flex-row justify-content-center align-items-center">{{ $article->links() }}</div>
    </div>

@endsection
