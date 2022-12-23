@extends('admin.layouts.app_admin')
@section('meta_title', 'Редагування даних контент менеджера')
@section('content')
<div class="container-fluid">
    @component('admin.components.breadcrumbs')
        @slot('title') Редагування користувача @endslot
        @slot('parent') Головна @endslot
        @slot('active') Користувач @endslot
    @endcomponent

    <form action="{{ route('admin.user-management.users.update', $user) }}" method="post">
        @method('PUT')
        @csrf
        
        {{-- include form--}}
        @include('admin.user-management.users._form')

    </form>

</div>
@endsection