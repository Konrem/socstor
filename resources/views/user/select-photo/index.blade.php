@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
		@slot('title') Список фото @endslot
		@slot('parent') Головна @endslot
    @endcomponent
    
	<form id="form-select-photo"	
		class="form-horizontal"
		method="post"
        enctype="multipart/form-data"
        action="{{ route('user.select-photo.store') }}"
    >
        @method('POST')
		@csrf
		<select-photo
        @isset($photos)
            upload_photos="{{$photos}}"
        @endisset />
	</form>

</div>
@endsection