@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Редагування @endslot
        @slot('parent') Головна @endslot
        @slot('active') Співробіткник @endslot
    @endcomponent

    <form action="{{route('user.emploee.update', $emploee)}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
       {{-- Form include --}}
      @include('user.emploee._form')
      
    </form>
</div>
@endsection