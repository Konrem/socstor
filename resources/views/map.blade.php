
@extends("layouts.app")

@section('meta_title', $map->first_title)
@section('meta_keywords', $map->meta_keywords)
@section('meta_description', $map->meta_description)

@section('content')
        <div class="page-title">
            <span>{{ $map->first_title }}</span>
        </div>
        <div class="info-page">
            <div class="description">{!! $map->description !!}</div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/d/embed?mid=zUazofjOhDWs.kLqcdAyYAaEY" width="100%" height="680"></iframe>
        </div>
@endsection