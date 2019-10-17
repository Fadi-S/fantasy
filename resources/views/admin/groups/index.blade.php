@extends('admin.master')

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Groups</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Groups</li>
        </ul>
    </div>

    <div class="col-12">
        <a class="btn btn-success" href="{{ url("admin/groups/create") }}">Create Group</a>
        <br><br>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">All Groups Table</h3>
            </div>

            <div class="card-body">

                {{ $groups->render() }}
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>View</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                                <tr>
                                    <td></td>
                                    <td>{{ $group->name }}</td>
                                    <td><a href="{{ url("admin/groups/$group->slug") }}" class="btn btn-primary">View</a></td>
                                    <td>
                                        <a href="{{ url("admin/groups/$group->slug/edit") }}" class="btn btn-info">Edit</a>
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
    <title>All Groups | StGeorge Thanawy</title>
@endsection