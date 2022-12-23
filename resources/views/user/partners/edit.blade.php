@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Редагування @endslot
        @slot('parent') Головна @endslot
        @slot('active') {{$partners->link}} @endslot
    @endcomponent

    <form action="{{route('user.partners.update', $partners)}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
       {{-- Form include --}}
      @include('user.partners._form')
      
    </form>
</div>
@endsection