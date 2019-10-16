@extends("admin.master")

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Edit '{{ $admin->name }}'</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/admins') }}">Admins</a></li>
            <li class="breadcrumb-item"><a href="{{ url("admin/admins/$admin->username") }}">{{ $admin->name }}</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ul>
    </div>

    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Admin</h3>
                        </div>
                        @include("admin.delete", ['what'=>"Admin", "url"=> url("admin/admins/$admin->username")])
                        <div class="card-body">
                            {!! Form::model($admin, ['method'=>"PATCH", 'url'=>url("admin/admins/$admin->username")]) !!}
                            @include('admin.admins.form', ['submit' => "Edit Admin", "create"=>false])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('title')
    <title>
        Edit Admin | StGeorge Thanawy
    </title>
@endsection