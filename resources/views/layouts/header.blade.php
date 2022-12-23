<header>
    <div class="info-header">
        <div class="title">
            <div class="title-head">
                <p>Відділ<br>соціальної роботи<br>зі студентською молоддю</p>
            </div>
            <div class="title-text">
                <p>{{ $config->description }}</p>
            </div>
            <div class="blue-block">
            </div>
        </div>
    </div>
    <div class="carusel">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($sliders as $slider)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="@if($loop->first) active @endif"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($sliders as $slider)
                    <div class="carousel-item @if($loop->first) active @endif ">
                        <img class="d-block w-100" src="{{ $slider->getPath()}}" alt="{{ $loop->index}}">

                        <div class="slider-description">
                            <div class="slider-block">
                                {{-- <p class="slider-title">{{ $slider->title }}</p> --}}
                                <p class="slider-text">{{ $slider->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="title-text mobile {{ (request()->is('/')) ? 'mobile-title-text' : '' }}">
        <p>{{ $config->description }}</p>
    </div>
</header>
