<!-- add from layouts -->
@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Список інформаціних блоків @endslot
        @slot('parent') Головна @endslot
        @slot('active') Інформаційні блоки @endslot
    @endcomponent

    <br>

    <a role="button" href="{{ route('user.blocks.index') }}" class="btn btn-outline-info">
        Повернутись 
    </a>
    <a role="button" href="{{ route('user.blocks.edit', $block) }}" class="btn btn-success">
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
                <td>{{ $block->title }}</td>
            </tr>
            @isset($block->img)
            <tr>
                <td>@lang('messages.photo')</td>
                <td><img src="{{ $block->getPath() }}" alt="альтернативный текст" width="250"></td>
            </tr>
            @endisset
            
            <tr>
                <td>@lang('messages.content')</td>
                <td>{!! $block->text !!}</td>
            </tr>
            @isset($block->link)
            <tr>
                <td>@lang('messages.link')</td>
                <td> <a href="{{ $block->link }}">{{ $block->link }}</a></td>
            </tr>
            @endisset
            <tr>
                <td>@lang('messages.relation')</td>
                <td>{{ $block->getType() }}</td>
            </tr>
        </tbody>
    </table>

</div>

@endsection