@extends("layouts.app")

@section('meta_title', $configs->name)
@section('meta_keywords', $configs->keywords)
@section('meta_description', $configs->description)

@section('content')
    <div class="info-blocks">
        @foreach($mainInfo as $item)
        <div class="info">
            <div class="info-head">{!! $item->title ?? "" !!}</div>
            <div class="info-main">
                <div class="info-pic">
                    <img class="info-block-pic" src="{{ $item->getPath() }}" alt="{{ $item->title ?? ""}}"> 
                </div>
                <div class="info-text">{!! $item->text ?? "" !!}</div>
                <div class="info-button">
                    <a href="{{ $item->link }}" rel="noreferrer"><button class="btn-details">Детальніше</button></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="news">
        <div class="news-header">
            <span>ОСТАННІ НОВИНИ</span>
            <a href="{{ route('news') }}">+ Більше новин</a>
        </div>
        @foreach($lastNews as $news)
        <hr>
        <div class="news-item">
            <div class="full-date">
                {{ $news->fullDateMobile() }}
            </div>
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
                <img src="{{ $news->getPath() }}" alt="{{ $news->title }}">
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
                    <a href="{{ 'news/' . $news->slug }}">
                        Читати повністю
                        <img src="img/right-arrow(1).svg" alt="Читати повністю {{ $news->title }} ">
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        <hr>

        <div class="more-news">
            <a href="{{ route('news') }}" role="button" class="more-news-btn" aria-label="Читати {{ $news->title}} "> Більше новин </a>
        </div>
    </div>
    @if (count($slider) >= 1)
    <div class="partners-carusel">
        <div class="slider">
            <section class="row autoplay slider__items">
            @foreach ($slider as $sliders) 
                <div class="col">
                    <a href="{{ $sliders->link }}" target="_blank" rel="noreferrer"> 
                        <img src="{{ asset('/storage/'. $sliders->image) }}" alt="{{ $loop->index}}" class="slider__image img-fluid">
                    </a>
                </div>
            @endforeach
            </section>
        </div>
    </div>
    @endif
@endsection


@push('footer')

    <script src="{{ asset('js/partners-carusel.js') }}" defer></script>
@endpush
