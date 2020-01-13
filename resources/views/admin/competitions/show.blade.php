@extends("admin.master")

@section("content")
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Competition</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/groups') }}">Groups</a></li>
            <li class="breadcrumb-item"><a href="{{ url("admin/groups/" . $competition->group->slug) }}">{{ $competition->group->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/competitions') }}">Competitions</a></li>
            <li class="breadcrumb-item active">{{ $competition->name }}</li>
        </ul>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">{{ $competition->name }}</h3>
                <div class="ml-auto">
                    <a href="{{ url("admin/competitions/$competition->slug/edit") }}" class="btn btn-info">Edit</a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div>
                        <div class="info"><strong>Name:</strong> {{ $competition->name }}</div>
                        <div class="info"><strong>Group:</strong> {{ $competition->group->name }}</div>
                        <div class="info"><strong>Type:</strong> {{ $competition->type->name }}</div>
                        <div class="info"><strong>Date:</strong> {{ $competition->start->format("l, d M Y") }} - {{ $competition->end->format("l, d M Y") }}</div>

                        <a class="btn btn-primary" href="{{ url("admin/users/calculate/$competition->slug") }}">Calculate Points</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Quizzes Table</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Questions</th>
                            <th>Time in minutes</th>
                            <th>View</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($competition->quizzes as $quiz)
                            <tr>
                                <td>{{ $quiz->name }}</td>
                                <td>{{ $quiz->start_date->format("l, d F Y h:i a") }}</td>
                                <td>{{ $quiz->end_date->format("l, d F Y h:i a") }}</td>
                                <td>{{ $quiz->questions->count() }}</td>
                                <td>{{ $quiz->max_minutes }} minute{{ ($quiz->max_minutes > 1) ? "s" : "" }}</td>
                                <td><a href="{{ url("admin/quizzes/$quiz->id") }}" class="btn btn-primary">View</a></td>
                                <td>
                                    <a href="{{ url("admin/quizzes/$quiz->id/edit") }}" class="btn btn-info">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Users Table</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Group</th>
                            <th>Year</th>
                            <th>Points</th>
                            <th>View</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($competition->users as $user)
                            <tr>
                                <td><img alt="{{ $user->name }}'s Picture" src="{{ $user->picture }}" width="70"></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->group->name }}</td>
                                <td>{{ $user->year->name }}</td>
                                <td>{{ $user->pivot->points }}</td>
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

    <style>
        .info {
            margin-bottom: 20px;
        }
    </style>
@endsection

@section("title")
    <title>
        View Competition | StGeorge Thanawy
    </title>
@endsection