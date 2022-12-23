@extends("layouts.app")

@section('meta_title', $volonter->first_title)
@section('meta_keywords', $volonter->meta_keywords)
@section('meta_description', $volonter->meta_description)

@section('content')
    <div class="page-title">
        <span>{{ $volonter->first_title }}</span>
    </div>

    <div class="info-page">
        <div class="description">
            {!! $volonter->description !!}
        </div>

        <div class="photos">
        @foreach ($lastAlbums as $albums)
            <div class="photo">
                <a href='{{route('album', ['id' => $albums->id])}}'>
                    <img src="{{asset('/storage/' . $albums->preview)}}" alt="">
                    <div class="album-description">{{$albums->title}}</div>
                </a>
            </div>
        @endforeach
        </div>

        <div class="more-news">
            <a href="{{route('albums')}}"><button class="more-albums-btn"> Перейти до фотоальбомів</button> </a>
        </div>
    </div>
@endsection
