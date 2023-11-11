@extends('admin.layouts.app_admin')
@section('meta_title', 'Додавання контент менеджера')
@section('content')
<div class="container-fluid">
    @component('admin.components.breadcrumbs')
        @slot('title') Користувачі @endslot
        @slot('parent') Головна @endslot
        @slot('active') Всі користувачі @endslot
    @endcomponent

    <a href="{{ route('admin.user-management.users.create') }}" class="btn btn-primary">
        <i class="far fa-plus-square"></i> Додати користувача
    </a>

    <br>
    </br>

    <table class="table table-striped">
        <thead>
            <th>Ім'я</th>
            <th>Email</th>
            <th class="text-right">Дії</th>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="text-right">
                    <form action="{{ route('admin.user-management.users.destroy', $user) }}"
                        onsubmit="if(confirm('Справді видалити?') ) { return true} else { return false }" 
                        method="post">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-default" href="{{ route('admin.user-management.users.edit', ['user'=> $user->id]) }}">
                            <i class="far fa-edit"></i>
                        </a>
                        <button type="submit" class="btn"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">
                    <h2 class="text-center">Записи відсутні!</h2>
                </td>
            </tr>

        @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination">
                        {{ $users->links() }}
                    </ul>
                </td>
            </tr>
        </tfoot>     

    </table>
</div>
@endsection