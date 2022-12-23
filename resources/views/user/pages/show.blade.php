<!-- add from layouts -->
@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Перегляд  @endslot
        @slot('parent') Головна @endslot
        @slot('active') Сторінка: {{ $page->first_title }} @endslot
    @endcomponent

    <br>

    <a role="button" href="{{ route('user.pages.index') }}" class="btn btn-outline-info">
        Повернутись 
    </a>
    <a role="button" href="{{ route('user.pages.edit', $page) }}" class="btn btn-success">
        Редагувати 
    </a>
    <br><br>
    <table class="table table-striped">
        <thead>
            <th>Поле</th>
            <th>Значення</th>
        </thead>
        <tbody>
            <tr>
                <td>@lang('messages.title')</td>
                <td>{{ $page->first_title }}</td>
            </tr>
            
            <tr>
                <td>@lang('messages.content')</td>
                <td>{!! $page->description !!}</td>
            </tr>
            <tr>
                <td>@lang('messages.meta_keywords')</td>
                <td>{{ $page->meta_keywords }}</td>
            </tr>
            <tr>
                <td>@lang('messages.meta_description')</td>
                <td>{{ $page->meta_description }}</td>
            </tr>
        </tbody>
    </table>

</div>

@endsection