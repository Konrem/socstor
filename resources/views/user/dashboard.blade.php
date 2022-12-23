<!-- add directive and way to layout -->
@extends('user.layouts.app_user')

@section('content')
@push('style')

@endpush
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron d-flex justify-content-center align-items-center jumbotron-image">
                <h1><span class="badge badge-pill badge-secondary">Всього новин: {{$count_new}}</span></h1>
            </div>
        </div>
    </div>
    @foreach ($new as $news)
        <div class="row py-2">
            <div class="col-sm-4">
                <img class="rounded img-fluid mb-3" src="{{ $news->getPath() }}" alt="{{ $news->title }}">
            </div>
            <div class="col-sm-8">
                <h3>{{ $news->title }}</h3>
                <p><b>{{ $news->meta_description }}</b><br>
                    Дата публікації: {{ $news->fullDate() }}
                </p>

                <a class="btn btn-primary mb-1"
                    href="{{ route('user.news.edit', $news) }}"
                    role="button" >
                    Редагувати
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection
