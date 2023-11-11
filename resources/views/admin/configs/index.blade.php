@extends('admin.layouts.app_admin')
@section('meta_title', 'Конфігурація додатка')
@section('content')
<div class="container-fluid">
@component('admin.components.breadcrumbs')
    @slot('title' ) Конфігурація додатка @endslot
    @slot('parent') Головна @endslot
    @slot('active') Поточна Конфігурація @endslot
@endcomponent('content')

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col-3">Ключ</th>
                <th scope="col-9">Значення</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row">Назва </td>
                <td>{{ $configs->name }}</td>
            </tr>
            <tr>
                <td scope="row">Опис </td>
                <td>{{ $configs->description }}</td>
            </tr>
            <tr>
                <td scope="row">Телефон </td>
                <td>{{ $configs->telephone }}</td>
            </tr>
            <tr>
                <td scope="row">E-mail </td>
                <td>{{ $configs->email }}</td>
            </tr>
            <tr>
                <td scope="row">E-mail опис</td>
                <td>{{ $configs->e_description }}</td>
            </tr>
            <tr>
                <td scope="row">Адреса </td>
                <td>{{ $configs->address }}</td>
            </tr>
            
            <tr>
                <td scope="row">Ключові слова </td>
                <td>{{ $configs->keywords }}</td>
            </tr>
            
            <tr>
                <td scope="row">Instagram </td>
                <td>{{ $configs->instagram }}</td>
            </tr>

            <tr>
                <td scope="row">Instagram опис</td>
                <td>{{ $configs->i_description }}</td>
            </tr>

            <tr>
                <td scope="row">Facebook</td>
                <td>{{ $configs->facebook }}</td>
            </tr>

            <tr>
                <td scope="row">Facebook опис</td>
                <td>{{ $configs->f_description }}</td>
            </tr>

            <tr>
                <td scope="row">youtube</td>
                <td>{{ $configs->youtube }}</td>
            </tr>
        </tbody>
    </table>

    <a class="btn btn-primary" role="button" href="{{ route('admin.configs.edit', ['config' => $configs->id]) }}" >Редагувати</a>
    
</div>
@endsection