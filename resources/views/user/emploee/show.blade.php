<!-- add from layouts -->
@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') @lang('messages.emploee') @endslot
        @slot('parent') Головна @endslot
        @slot('active') {{ $emploee->title }} @endslot
    @endcomponent

    <br>

    <a role="button" href="{{ route('user.emploee.index') }}" class="btn btn-outline-info">@lang('messages.back')</a>
    <a role="button" href="{{ route('user.emploee.edit', $emploee) }}" class="btn btn-success">@lang('messages.edit')</a>
    <br><br>
    <table class="table table-striped">
        <thead>
            <th>Поле</th>
            <th>Значення</th>
        </thead>
        <tbody>
            <tr>
                <td>@lang('messages.fpib')</td>
                <td>{{ $emploee->title }}</td>
            </tr>
            @isset($emploee->img)
            <tr>
                <td>@lang('messages.photo')</td>
                <td><img src="{{ $emploee->getPath() }}" alt="альтернативный текст" width="250"></td>
            </tr>
            @endisset
            
            <tr>
                <td>@lang('messages.content')</td>
                <td>{!! $emploee->text !!}</td>
            </tr>
        </tbody>
    </table>

</div>

@endsection