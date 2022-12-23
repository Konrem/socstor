<!-- add from layouts -->
@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Список слайдів @endslot
        @slot('parent') Головна @endslot
        @slot('active') {{ $partners->link }} @endslot
    @endcomponent

    <br>
    <a role="button" href="{{ route('user.partners.index') }}" class="btn btn-outline-info">@lang('messages.back')</a>
    <a role="button" href="{{ route('user.partners.edit', $partners) }}" class="btn btn-success">@lang('messages.edit')</a>
    <br><br>
    <table class="table table-striped">
        <thead>
            <th>Поле</th>
            <th>Значення</th>
        </thead>
        <tbody>
            <tr>
                <td>Посилання</td>
                <td>{{ $partners->link }}</td>
            </tr>
            @isset($partners->image)
            <tr>
                <td>@lang('messages.photo')</td>
                <td><img src="{{ $partners->getPath() }}" alt="альтернативный текст" height="200" width="300"></td>
            </tr>
            @endisset
        </tbody>
    </table>

</div>

@endsection