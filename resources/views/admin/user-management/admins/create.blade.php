@extends('admin.layouts.app_admin')
@section('meta_title', 'Додавання адміністратора')
@section('content')
<div class="container-fluid">
    @component('admin.components.breadcrumbs')
        @slot('title') Створення корустувача @endslot
        @slot('parent') Головна @endslot
        @slot('active') Користувач @endslot
    @endcomponent

    <form action="{{ route('admin.user-management.admins.store') }}" method="post">
        @csrf

        {{-- include form--}}
        @include('admin.user-management.admins._form')

    </form>

</div>
@endsection