@extends('admin.layouts.app_admin')
@section('meta_title', 'редагування конфігурацій додатка')
@section('content')
    <div class="container-fluid">
    @component('admin.components.breadcrumbs')
        @slot('title') Редагування конфігурацій @endslot
        @slot('parent') Головна @endslot
        @slot('active') Конфігурація @endslot
    @endcomponent

    <form action="{{ route('admin.configs.update', $config) }}" method="post">
        @method('PUT')
        @csrf
        
        @include('admin.configs._form')
    </form>

    </div>
@endsection