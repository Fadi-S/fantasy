@extends('admin.master')

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Characters</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Characters</li>
        </ul>
    </div>

    <div class="col-12">
        <a class="btn btn-success" href="{{ url("admin/characters/create") }}">Create Character</a>
        <br><br>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">All Characters Table</h3>
            </div>

            <div class="card-body">

                {{ $characters->render() }}
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>View</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($characters as $character)
                                <tr>
                                    <td><img src="{{ $character->picture }}" width="70"></td>
                                    <td>{{ $character->name }}</td>
                                    <td>{{ $character->category->name }}</td>
                                    <td><a href="{{ url("admin/characters/$character->id") }}" class="btn btn-primary">View</a></td>
                                    <td>
                                        <a href="{{ url("admin/characters/$character->id/edit") }}" class="btn btn-info">Edit</a>
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
    <title>All Characters | StGeorge Thanawy</title>
@endsection