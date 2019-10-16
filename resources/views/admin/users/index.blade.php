@extends('admin.master')

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Users</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ul>
    </div>

    <div class="col-12">
        <a class="btn btn-success" href="{{ url("admin/users/create") }}">Create User</a>
        <br><br>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">All Users Table</h3>
            </div>

            <div class="card-body">

                {{ $users->render() }}
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Points</th>
                                <th>View</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><img src="{{ $user->picture }}" width="70"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->points }}</td>
                                    <td><a href="{{ url("admin/users/$user->username") }}" class="btn btn-primary">View</a></td>
                                    <td>
                                        <a href="{{ url("admin/users/$user->username/edit") }}" class="btn btn-info">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("title")
    <title>All Users | StGeorge Thanawy</title>
@endsection