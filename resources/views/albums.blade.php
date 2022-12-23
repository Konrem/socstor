@extends("layouts.app")

@section('meta_title', $page->first_title )
@section('meta_keywords', $page->meta_keywords)
@section('meta_description', $page->meta_description)

@section('content')
        <div class="page-title">
            <span>{{ $page->first_title }}</span>
        </div>

        <div class="info-page">
            <div class="description">{!! $page->description !!}</div>
        </div>
        <div class="col ">
            @if (count($albums) === 0)
                <h3 class="text-center">Тут поки що порожньо</h3>
            @endif
            <div class="albums">
                @forelse ($albums as $album)
                <div class="album">
                    <a href='{{route('album', ['id' => $album->id])}}'>
                        <img src="{{ asset('/storage/' . $album->preview)}}">
                        <div class="album-description">{{$album->title}}</div>
                    </img>
                    </a>
                </div>
               @empty
               @endforelse
            </div>
            <div class="d-flex justify-content-center">{{$albums->links()}}</div>

        </div>
@endsection