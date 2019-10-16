@extends("admin.master")

@section("content")
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Character</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/characters') }}">Characters</a></li>
            <li class="breadcrumb-item active">{{ $character->name }}</li>
        </ul>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">{{ $character->name }}</h3>
                <div class="ml-auto">
                    <a href="{{ url("admin/characters/$character->id/edit") }}" class="btn btn-info">Edit</a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                        <img src="{{ $character->picture }}" class="img-thumbnail" style="height: auto; width:100%;">
                    </div>
                    <div>
                        <div class="info"><strong>Name:</strong> {{ $character->name }}</div>
                        <div class="info"><strong>Category:</strong> {{ $character->category->name }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Questions Table</h3>
                <a class="btn btn-success ml-auto" href="{{ url("/admin/questions/create?character_id=$character->id") }}">Add Question</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                        <tr>
                            <th>Question</th>
                            <th>Points</th>
                            <th>Quiz</th>
                            <th>View</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($character->questions as $question)
                            <tr>
                                <td>{{ $question->body }}</td>
                                <td>{{ $question->points }}</td>
                                <td><a href="{{ url("admin/quizzes/" . $question->quiz->id) }}">{{ $question->quiz->name }}</a></td>
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
                <a class="btn btn-success ml-auto" href="{{ url("/admin/texts/create?character_id=$character->id") }}">Add Shahed</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                        <tr>
                            <th>Shahed</th>
                            <th>Quiz</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($character->texts as $text)
                            <tr>
                                <td>{{ $text->name }}</td>
                                <td><a href="{{ url("admin/quizzes/" . $text->quiz->id) }}">{{ $text->quiz->name }}</a></td>
                                <td><a class="btn btn-info" href="{{ url("admin/texts/$text->id/edit") }}">Edit</a></td>
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
        View Character | StGeorge Thanawy
    </title>
@endsection