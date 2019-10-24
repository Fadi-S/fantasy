@extends('admin.master')

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Quizzes</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Quizzes</li>
        </ul>
    </div>

    <div class="col-12">
        <a class="btn btn-success" href="{{ url("admin/quizzes/create") }}">Create Quiz</a>
        <br><br>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">All Quizzes Table</h3>
            </div>

            <div class="card-body">

                {{ $quizzes->render() }}
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Time</th>
                                <th>For Group</th>
                                <th>Competition</th>
                                <th>Total Questions</th>
                                <th>View</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quiz)
                                <tr>
                                    <td></td>
                                    <td>{{ $quiz->name }}</td>
                                    <td>{{ $quiz->start_date->format("l, d F Y") }}</td>
                                    <td>{{ $quiz->end_date->format("l, d F Y") }}</td>
                                    <td>{{ $quiz->max_minutes }}</td>
                                    <td>{{ $quiz->competition->group->name }}</td>
                                    <td>{{ $quiz->competition->name }}</td>
                                    <td>{{ $quiz->questions->count() }}</td>
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

@endsection

@section("title")
    <title>All Quizzes | StGeorge Thanawy</title>
@endsection