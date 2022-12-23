@extends('admin.layouts.app_admin')

@section('meta_title', 'Панель пдмністратора')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3 class="text-center">Вітання Адміністраторе!</h3></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <img src="/img/UUcK.gif" alt="mars" class="img-fluid rounded mx-auto d-block">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection