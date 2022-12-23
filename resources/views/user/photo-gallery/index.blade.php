@extends('user.layouts.app_user')

@section('content')

<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Список альбомів @endslot
        @slot('parent') Головна @endslot
        @slot('active') Альбоми @endslot
    @endcomponent

    <a href="{{ route('user.photo-gallery.create') }}" class="btn btn-primary float-left beetwen">
        <i class="fas fa-plus"></i> Створити альбом
    </a>

    <table class="table table-striped">
         <thead>
            <th>Назва фото альбому</th>
            <th class="text-right action">Дія</th>
        </thead>
        <tbody>
            @forelse ($galleries as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td class="float-right">
                        <form
                            onsubmit="if(confirm('Видалити?')) { return true }else{ return false }"
                            action="{{route('user.photo-gallery.destroy', $item)}}"
                            method="post"
                        >
                            <input type="hidden" name="_method" value="DELETE">
                                @csrf

                            <a class="btn btn-default" href="{{route('user.photo-gallery.edit', $item)}}"
                                title="Редагувати"
                            >
                                <i class="fas fa-edit"></i>
                            </a>

                            <button type="submit" class="btn" title="Видалити" ><i class="fas fa-trash-alt"></i></button>
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
                        {{ $galleries->links() }}
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection