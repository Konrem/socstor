@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">
   
        @component('user.components.breadcrumb')
            @slot('title') @lang('messages.emploee') @endslot
            @slot('parent') Головна @endslot
            @slot('active') @lang('messages.workers') @endslot
        @endcomponent
        <div class="row">
            <div class="col">
                <form class="form-horizontal" action="{{route('user.emploee.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <!-- {{-- Form include --}} -->
                @include('user.emploee._form')
        
                </form>
            </div>
            
        </div>
</div>
@endsection