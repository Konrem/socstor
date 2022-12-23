<!-- add from layouts -->
@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Список слайдів @endslot
        @slot('parent') Головна @endslot
        @slot('active') {{ $slider->id }} @endslot
    @endcomponent

    <br>

    <a role="button" href="{{ route('user.slider.index') }}" class="btn btn-outline-info">@lang('messages.back')</a>
    <a role="button" href="{{ route('user.slider.edit', $slider) }}" class="btn btn-success">@lang('messages.edit')</a>
    <br><br>
    <table class="table table-striped">
        <thead>
            <th>Поле</th>
            <th>Значення</th>
        </thead>
        <tbody>
            {{-- {{-- <tr> --}}
                {{-- <td>@lang('messages.title')</td> --}}
                {{-- <td>{{ $slider->title }}</td> --}}
            {{-- </tr> --}}
            @isset($slider->image)
            <tr>
                <td>@lang('messages.photo')</td>

                <td><img class="img-fluid img-thumbnail" src="{{ $slider->getPath() }}" width="500" alt="Відсутня картинка"></td>
            </tr>
            @endisset
            
            <tr>
                <td>@lang('messages.content')</td>
                <td>{!! $slider->description !!}</td>
            </tr>

            @if ($slider->link == null)
                <tr hidden>
                    <td>@lang('messages.link')</td>
                    <td>{!! $slider->link !!}</td>
                </tr>
            @else
                <tr>
                    <td>@lang('messages.link')</td>
                    <td>{!! $slider->link !!}</td>
                </tr>
            @endif
        </tbody>
    </table>

</div>

@endsection