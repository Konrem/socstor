@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Редагування альбому @endslot
        @slot('parent') Головна @endslot
        @slot('active') {{ $photo_gallery->title}} @endslot
    @endcomponent

    <hr>
    <form id="form-gallery" class="form-horizontal" action="{{route('user.photo-gallery.update', $photo_gallery)}}" method="POST" enctype="multipart/form-data">
      
      @method('PUT')        
      @csrf

        @include('user.photo-gallery._form')

      <input type="hidden" name="modified_by" value="{{Auth::id()}}">
    </form>
</div>
@endsection