@extends("layouts.app")

    @section('meta_title', $page->first_title)
    @section('meta_keywords',  $page->meta_keywords)
    @section('meta_description', $page->meta_description)

@section('content')
<div class="news">
    <div class="page-title">
        <span>{{ $page->first_title }}</span>
    </div>
     <div class="info-page">
        <div class="description">{!! $page->description !!}</div>
    </div>

    <news-component></news-component>
    
    <div class="partners-carusel">

    </div>
</div>
@endsection