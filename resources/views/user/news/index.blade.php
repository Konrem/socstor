<!-- add from layouts -->
@extends('user.layouts.app_user')

@section('content')
<div class="container-fluid">

    @component('user.components.breadcrumb')
        @slot('title') Список новин @endslot
        @slot('parent') Головна @endslot
        @slot('active') Новини @endslot
    @endcomponent

    <a href="{{route('user.news.create')}}" class="btn btn-primary float-left beetwen">
        <i class="fas fa-feather-alt"></i> Створити новину
    </a>

    <table class="table table-striped">
        <thead>
            <th>Найменування</th>
            <th>Публікування</th>
            <th class="text-right action">Дія</th>
        </thead>
        <tbody>
            @forelse ($new as $news)
                <tr>
                    <td>{{$news->title}}</td>
                    <td>{{ $news->getStatus() }}</td>
                    <td class="float-right">
                        <form onsubmit="if(confirm('Видалити?')) { return true }else{ return false }" action="{{route('user.news.destroy', $news)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                                @csrf

                            <a class="btn btn-default" href="{{route('user.news.edit', $news)}}">
                                    <i class="fas fa-edit"></i></a>

                            <button type="submit" class="btn"><i class="fas fa-trash-alt"></i></button>
                        </form>
    
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
                        {{$new->links()}}
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection