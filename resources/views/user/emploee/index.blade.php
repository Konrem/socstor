@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

@component('user.components.breadcrumb')
    @slot('title') @lang('messages.workers') @endslot
    @slot('parent') Головна @endslot
    @slot('active') @lang('messages.workers') @endslot
@endcomponent

    <a href="{{ route('user.emploee.create') }}" class="btn btn-primary float-left beetwen">
        <i class="fas fa-feather-alt"></i> Додати Співробітника
    </a>

    <table class="table table-striped">
        <thead>
            <th>@lang('messages.workers')</th>
            <th class="text-right action">Дія</th>
        </thead>
        <tbody>
            @forelse ($emploee as $worker)
                <tr>
                    <td>{{ $worker->title }}</td>
                    <td class="float-right">
                    <form onsubmit="if(confirm('Видвлити?') ){ return true } else { return false }"
                        action="{{ route('user.emploee.destroy', $worker) }}" method="post">
                        @csrf
                        @method('DELETE')
                        
                        <a class="btn btn-default" href="{{route('user.emploee.edit', $worker) }}"
                            title="Редагувати"><i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-default" href="{{route('user.emploee.show', $worker) }}"
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
                        {{$emploee->links()}}
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection