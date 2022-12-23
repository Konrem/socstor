@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title')  Список альбомів @endslot
        @slot('parent') Головна @endslot
        @slot('active') Альбоми @endslot
    @endcomponent
    
	<form id="form-gallery"
		class="form-horizontal"
		action="{{ route('user.photo-gallery.store') }}"
		method="post"
		enctype="multipart/form-data"
	>
		@csrf
		@include('user.photo-gallery._form')
				
		<input type="hidden" name="created_by" value="{{ Auth::id() }}">
	</form>

</div>
@endsection
