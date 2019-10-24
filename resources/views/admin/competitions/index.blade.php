@extends('admin.master')

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Competitions</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Competitions</li>
        </ul>
    </div>

    <div class="col-12">
        <a class="btn btn-success" href="{{ url("admin/competitions/create") }}">Create Competition</a>
        <br><br>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">All Competitions Table</h3>
            </div>

            <div class="card-body">

                {{ $competitions->render() }}
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>For Group</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>View</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($competitions as $competition)
                                <tr>
                                    <td></td>
                                    <td>{{ $competition->name }}</td>
                                    <td>{{ $competition->group->name }}</td>
                                    <td>{{ $competition->type->name }}</td>
                                    <td>{{ $competition->start->format("l, d M Y") }}</td>
                                    <td>{{ $competition->end->format("l, d M Y") }}</td>
                                    <td><a href="{{ url("admin/competitions/$competition->slug") }}" class="btn btn-primary">View</a></td>
                                    <td>
                                        <a href="{{ url("admin/competitions/$competition->slug/edit") }}" class="btn btn-info">Edit</a>
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
    <title>All Competitions | StGeorge Thanawy</title>
@endsection