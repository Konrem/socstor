@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Редагування @endslot
        @slot('parent') Головна @endslot
        @slot('active') {{ $page->first_title }} @endslot
    @endcomponent

    <form action="{{route('user.pages.update', $page)}}" method="post">
        @method('PUT')
        @csrf
       {{-- Form include --}}
      @include('user.pages._form')
      
    </form>
</div>
@endsection