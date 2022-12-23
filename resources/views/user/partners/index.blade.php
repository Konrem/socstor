@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

@component('user.components.breadcrumb')
    @slot('title') Список слайдів @endslot
    @slot('parent') Головна @endslot
    @slot('active') Слайди з партнерами @endslot
@endcomponent

    <a href="{{ route('user.partners.create') }}" class="btn btn-primary float-left beetwen">
        <i class="fas fa-feather-alt"></i> Додати слайд з партнером
    </a>

    <table class="table table-striped">
        <thead>
            <th>Список слайдів з партнерами</th>
            <th class="text-right action">Дія</th>
        </thead>
        <tbody>
            @forelse ($partners as $partner)
                <tr>
                    <td>{{ $partner->link }}</td>
                    <td class="float-right">
                    <form onsubmit="if(confirm('Видвлити?') ){ return true } else { return false }"
                        action="{{ route('user.partners.destroy', $partner) }}" method="post">
                        @csrf
                        @method('DELETE')
                        
                        <a class="btn btn-default" href="{{route('user.partners.edit', $partner) }}"
                            title="Редагувати"><i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-default" href="{{route('user.partners.show', $partner) }}"
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
                        {{$partners->links()}}
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection