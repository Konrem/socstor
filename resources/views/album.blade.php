@extends("layouts.app")

    @section('meta_title', $header)

@section('content')
    <modal-photo
        album="{{ $album }}" 
        header="{{ $header }}"
    />
@endsection