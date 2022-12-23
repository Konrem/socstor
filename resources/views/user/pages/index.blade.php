@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Сторінки @endslot
        @slot('parent') Головна @endslot
        @slot('active') Сторінки @endslot
    @endcomponent

    <br><br>

    <table class="table table-striped">
        <thead>
            <th>id</th>
            <th>Найменування</th>
            <th class="text-right action">Дія</th>
        </thead>
        <tbody>
            @forelse ($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->first_title }}</td>
                    <td class="float-right">
                    <form method="post">
                        <a class="btn btn-default" href="{{route('user.pages.edit', $page)}}"
                            title="Редагувати"><i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-default" href="{{route('user.pages.show', $page)}}"
                            title="Переглянути">
                            <i class="far fa-eye"></i>
                        </a>
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
                <td colspan="3">
                    <ul class="pagination float-right">
                        {{ $pages->links() }}
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection