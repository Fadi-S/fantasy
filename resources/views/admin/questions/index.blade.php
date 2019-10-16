@extends('admin.master')

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Questions</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Questions</li>
        </ul>
    </div>

    <div class="col-12">
        <a class="btn btn-success" href="{{ url("admin/questions/create") }}">Create Question</a>
        <br><br>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">All Questions Table</h3>
            </div>

            <div class="card-body">

                {{ $questions->render("pagination::bootstrap-4") }}
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                        <tr>
                            <th>Question</th>
                            <th>Character Name</th>
                            <th>Quiz Name</th>
                            <th>View</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td>{{ $question->body }}</td>
                                <td><a href="{{ url('admin/characters/' . $question->character->id) }}">{{ $question->character->name }}</a></td>
                                <td><a href="{{ url('admin/quizzes/' . $question->quiz->id) }}">{{ $question->quiz->name }}</a></td>
                                <td><a href="{{ url("admin/questions/$question->id") }}" class="btn btn-primary">View</a></td>
                                <td>
                                    <a href="{{ url("admin/questions/$question->id/edit") }}" class="btn btn-info">Edit</a>
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
    <title>All Questions | StGeorge Thanawy</title>
@endsection