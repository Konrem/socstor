@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Інформаційний блок @endslot
        @slot('parent') Головна @endslot
        @slot('active') Новий інформаційні блок @endslot
    @endcomponent

    <form class="form-horizontal" action="{{route('user.blocks.store')}}" method="post" enctype="multipart/form-data">
        @csrf
      <!-- {{-- Form include --}} -->
      @include('user.blocks._form')
      
    </form>
</div>
@endsection