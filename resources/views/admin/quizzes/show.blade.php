@extends("admin.master")

@section("content")
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Quiz</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/quizzes') }}">Quizzes</a></li>
            <li class="breadcrumb-item active">{{ $quiz->name }}</li>
        </ul>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">{{ $quiz->name }}</h3>
                <div class="ml-auto">
                    <a href="{{ url("admin/quizzes/$quiz->id/edit") }}" class="btn btn-info">Edit</a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div>
                        <div class="info"><strong>Name:</strong> {{ $quiz->name }}</div>
                        <div class="info"><strong>Time:</strong> {{ $quiz->max_minutes }} minute{{ ($quiz->max_minutes > 1) ? "s" : "" }}</div>
                        <div class="info"><strong>Start Date:</strong> {{ $quiz->start_date->format("l, d F Y") }}</div>
                        <div class="info"><strong>End Date:</strong> {{ $quiz->end_date->format("l, d F Y") }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Questions Table</h3>
                <a class="btn btn-success ml-auto" href="{{ url("/admin/questions/create?quiz_id=$quiz->id") }}">Add Question</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                        <tr>
                            <th>Question</th>
                            <th>Points</th>
                            <th>Character</th>
                            <th>View</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quiz->questions as $question)
                            <tr>
                                <td>{{ $question->body }}</td>
                                <td>{{ $question->points }}</td>
                                <td><a class="btn btn-link" href="{{ url("admin/characters/" . $question->character->id) }}">{{ $question->character->name }}</a></td>
                                <td><a class="btn btn-primary" href="{{ url("admin/questions/$question->id") }}">View</a></td>
                                <td><a class="btn btn-info" href="{{ url("admin/questions/$question->id/edit") }}">Edit</a></td>
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
                <h3 class="h4">Shawahed Table</h3>
                <a class="btn btn-success ml-auto" href="{{ url("/admin/texts/create?quiz_id=$quiz->id") }}">Add Shahed</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                        <tr>
                            <th>Shahed</th>
                            <th>Character</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quiz->texts as $text)
                            @if(!is_null($text->character))
                                <tr>
                                    <td>{{ $text->name }}</td>
                                    <td><a class="btn btn-link" href="{{ url("admin/characters/" . $text->character->id) }}">{{ $text->character->name }}</a></td>
                                    <td><a class="btn btn-info" href="{{ url("admin/texts/$text->id/edit") }}">Edit</a></td>
                                </tr>
                            @endif
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
        View Quiz | StGeorge Thanawy
    </title>
@endsection