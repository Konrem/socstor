@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Список слайдів @endslot
        @slot('parent') Головна @endslot
        @slot('active') Слайд @endslot
    @endcomponent

    <a href="{{ route('user.slider.create') }}" class="btn btn-primary float-left beetwen">
        <i class="fas fa-feather-alt"></i> Додати слайд
    </a>

    <table class="table table-striped">
        <thead>
            <th>Список слайдів</th>
            <th class="text-right action">Дія</th>
        </thead>
        <tbody>
            @forelse ($slider as $sliders)
                <tr>
                    <td>{{ $sliders->description }}</td>
                    <td class="float-right">
                    <form onsubmit="if(confirm('Видвлити?') ){ return true } else { return false }"
                        action="{{ route('user.slider.destroy', $sliders) }}" method="post">
                        @csrf
                        @method('DELETE')
                        
                        <a class="btn btn-default" href="{{route('user.slider.edit', $sliders) }}"
                            title="Редагувати"><i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-default" href="{{route('user.slider.show', $sliders) }}"
                            title="Переглянути">
                            <i class="far fa-eye"></i>
                        </a>

                        <button type="submit" title="Видалити" class="btn"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center"><h2>Дані відсутні</h2></td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <ul class="pagination float-right">
                        {{$slider->links()}}
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection
