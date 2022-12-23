@extends('admin.layouts.app_admin')
@section('meta_title', 'Редагування даних адміністратора')
@section('content')
<div class="container-fluid">
    @component('admin.components.breadcrumbs')
        @slot('title') Редагування @endslot
        @slot('parent') Головна @endslot
        @slot('active') Адмністратор @endslot
    @endcomponent

    <form action="{{ route('admin.user-management.admins.update', $admin) }}" method="post">
        @method('PUT')
        @csrf
        
        {{-- include form--}}
        @include('admin.user-management.admins._form')

    </form>

</div>
@endsection