@extends('admin.layouts.app_admin')
@section('meta_title', 'Керування адмністратораторами')
@section('content')
<div class="container-fluid">
    @component('admin.components.breadcrumbs')
        @slot('title') Адмністратори @endslot
        @slot('parent') Головна @endslot
        @slot('active') Всі Адмністратори @endslot
    @endcomponent

    <a href="{{ route('admin.user-management.admins.create') }}" class="btn btn-primary">
        <i class="far fa-plus-square"></i> Додати адміністратора
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
        @forelse($admins as $admin)
            <tr>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td class="text-right">
                    <form action="{{ route('admin.user-management.admins.destroy', $admin) }}"
                        onsubmit="if(confirm('Справді видалити?') ) { return true} else { return false }" 
                        method="post">
                        @csrf
                        @method('DELETE')
                        
                        <a class="btn btn-default" href="{{ route('admin.user-management.admins.edit', ['id'=> $admin->id]) }}">
                            <i class="far fa-edit"></i>
                        </a>
                        @if ( Auth::id() !== $admin->id)
                            <button type="submit" class="btn"><i class="fas fa-trash-alt"></i></button>
                        @endif
                        
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
                        {{ $admins->links() }}
                    </ul>
                </td>
            </tr>
        </tfoot>     

    </table>
</div>
@endsection