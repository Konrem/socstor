@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">
   
        @component('user.components.breadcrumb')
            @slot('title') Список слайдів @endslot
            @slot('parent') Головна @endslot
            @slot('active') Створення слайду @endslot
        @endcomponent
        <div class="row">
            <div class="col">
                <form class="form-horizontal" action="{{route('user.partners.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <!-- {{-- Form include --}} -->
                @include('user.partners._form')
        
                </form>
            </div>
            
        </div>
</div>
@endsection