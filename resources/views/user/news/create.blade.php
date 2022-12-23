@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Створення новини @endslot
        @slot('parent') Головна @endslot
        @slot('active') Новини @endslot
    @endcomponent

    <hr>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Створення новини</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Додати фото до новини</a>
      </li>
    </ul>
	<div class="tab-content" id="myTabContent">       
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
			<form id="form-news" class="form-horizontal" action="{{route('user.news.store')}}" method="post" enctype="multipart/form-data">
				@csrf
    			@include('user.news._form')
        		<input type="hidden" name="created_by" value="{{ Auth::id() }}">
			</form>              
		</div>

		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @include('user.news.gallery')
    </div>
	</div>
</div>
@endsection
