@extends('admin.master')

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Admins</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Admins</li>
        </ul>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">All Admins Table</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td><img src="{{ $admin->picture }}" width="70"></td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        <a href="{{ url("admin/admins/$admin->username/edit") }}" class="btn btn-info">Edit</a>
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
    <title>All Admins | StGeorge Thanawy</title>
@endsection