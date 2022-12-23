@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Редагування @endslot
        @slot('parent') Головна @endslot
        @slot('active') Інформаційні блоки @endslot
    @endcomponent

    <form action="{{route('user.blocks.update', $block)}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
       {{-- Form include --}}
      @include('user.blocks._form')
      
    </form>
</div>
@endsection