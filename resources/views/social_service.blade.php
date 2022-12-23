 
@extends("layouts.app")

@section('meta_title', $social->first_title)
@section('meta_keywords', $social->meta_keywords)
@section('meta_description', $social->meta_description)

@section('content')
        <div class="page-title">
            <span>{{ $social->first_title }}</span>
        </div>
        <div class="info-page">
            <div class="description">{!! $social->description !!}</div>

            <modal-social button="{{route('albums')}}"/>

        </div>
@endsection
