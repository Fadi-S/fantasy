@extends("admin.master")

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Edit '{{ $user->name }}'</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">Users</a></li>
            <li class="breadcrumb-item"><a href="{{ url("admin/users/$user->username") }}">{{ $user->name }}</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ul>
    </div>

    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">User</h3>
                        </div>
                        @include("admin.delete", ['what'=>"User", "url"=> url("admin/users/$user->username")])
                        <div class="card-body">
                            {!! Form::model($user, ['method'=>"PATCH", 'url'=>url("admin/users/$user->username")]) !!}
                            @include('admin.users.form', ['submit' => "Edit User"])
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
        Edit User | StGeorge Thanawy
    </title>
@endsection