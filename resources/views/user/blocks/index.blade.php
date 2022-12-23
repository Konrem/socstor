@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Список інформаціних блоків @endslot
        @slot('parent') Головна @endslot
        @slot('active') Інформаційні блоки @endslot
    @endcomponent

    <br>

    {{-- <a href="{{ route('user.blocks.create') }}" class="btn btn-primary float-left">
        <i class="fas fa-feather-alt"></i>Додати блок
    </a> --}}
    {{-- <br><br> --}}

    <table class="table table-striped">
        <thead>
            <th>Найменування</th>
            <th class="text-right">Тип</th>
            <th class="text-right action">Дія</th>
        </thead>
        <tbody>
            @forelse ($blocks as $block)
                <tr>
                    <td>{{ $block->title }}</td>
                    <td class="text-right">{{ $block->getType() }}</td>
                    <td class="float-right">
                        
                        <a class="btn btn-default" href="{{route('user.blocks.edit', $block)}}"
                            title="Редагувати"><i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-default" href="{{route('user.blocks.show', $block)}}"
                            title="Переглянути">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><h2>Дані відсутні</h2></td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination float-right">
                        {{$blocks->links()}}
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection