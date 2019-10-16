@extends("admin.master")

@section("content")
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">User</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">Users</a></li>
            <li class="breadcrumb-item active">{{ $user->name }}</li>
        </ul>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">{{ $user->name }}</h3>
                <div class="ml-auto">
                    <a href="{{ url("admin/users/$user->username/edit") }}" class="btn btn-info">Edit</a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                        <img src="{{ $user->picture }}" class="img-thumbnail" style="height: auto; width:100%;">
                    </div>
                    <div>
                        <div class="info"><strong>Name:</strong> {{ $user->name }}</div>
                        <div class="info"><strong>Email:</strong> {{ $user->email }}</div>
                        <div class="info"><strong>Total Points:</strong> <div style="display: inline-block;" id="totalPointsPreview">{{ $user->points }}</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Questions Table</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                        <tr>
                            <th>Character Picture</th>
                            <th>Character Name</th>
                            <th>Quiz</th>
                            <th>Points</th>
                            <th>Answer</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->questions as $question)
                            <tr>
                                <td><img src="{{ $question->character->picture }}" width="70" height="70"></td>
                                <td><a href="{{ url("admin/characters/" . $question->character->id) }}">{{ $question->character->name }}</a></td>
                                <td><a href="{{ url("admin/quizzes/" . $question->quiz->id) }}">{{ $question->quiz->name }}</a></td>
                                <td id="pointsPreview{{ $question->id }}">{{ $question->pivot->points }}/{{ $question->points }}</td>
                                <td>
                                    <button class="btn btn-success" data-target="#answer{{ $question->id }}" data-toggle="modal">
                                        View Answer
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="answer{{ $question->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span style="font-weight: bold;">Answer</span>
                                            <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <pre>{{ $question->choices()->find($question->pivot->answer)->name }}</pre>

                                            <label for="points{{ $question->id }}">
                                                Points
                                            </label>
                                            <input max="{{ $question->points }}" min="0" type="number" class="form-control" value="{{ $question->pivot->points }}" name="points{{ $question->id }}" id="points{{ $question->id }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success" data-dismiss="modal" name="saveBtn" id="{{ $question->id }}">Save</button>
                                            <button class="btn btn-info" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('button[name="saveBtn"]').click(function() {
                var question_id = $(this).attr("id");
                var points = $("#points" + question_id).val();

                $.ajax({
                    url: "{{ url("admin/users/$user->username/savePoints") }}",
                    type: "POST",
                    data: {_token: "{{ csrf_token() }}", question_id: question_id, points: points},
                    success: function(response) {
                        $("#pointsPreview" + question_id).html(response["points"]);
                        $("#totalPointsPreview").html(response["total_points"]);
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>

    <style>
        .info {
            margin-bottom: 20px;
        }
    </style>
@endsection

@section("title")
    <title>
        View User | StGeorge Thanawy
    </title>
@endsection