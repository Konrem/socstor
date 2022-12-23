@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Редагування @endslot
        @slot('parent') Головна @endslot
        @slot('active') {{$slider->id}} @endslot
    @endcomponent

    <form action="{{route('user.slider.update', $slider)}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
       {{-- Form include --}}
      @include('user.slider._form')
      
    </form>
</div>
@endsection