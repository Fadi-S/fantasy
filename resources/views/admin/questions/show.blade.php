@extends("admin.master")

@section("content")
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Question</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/groups') }}">Groups</a></li>
            <li class="breadcrumb-item"><a href="{{ url("admin/groups/" . $question->quiz->competition->group->slug) }}">{{ $question->quiz->competition->group->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/competitions') }}">Competitions</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/competitions/' . $question->quiz->competition->slug) }}">{{ $question->quiz->competition->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url("admin/quizzes/" . $question->quiz->id) }}">{{ $question->quiz->name }}</a></li>
            <li class="breadcrumb-item active">Question</li>
        </ul>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">{{ $question->character->name }}</h3>
                <div class="ml-auto">
                    <a href="{{ url("admin/questions/$question->id/edit") }}" class="btn btn-info">Edit</a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                        <img src="{{ $question->character->picture }}" class="img-thumbnail" style="height: auto; width:100%;">
                    </div>
                    <div>
                        <div class="info"><strong>Question:</strong> {{ $question->body }}</div>
                        <div class="info"><strong>Maximum Points:</strong> {{ $question->points }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="row">
            @foreach($question->choices as $choice)
                <div class="col-3">
                    <div class="card">
                        <div class="card-header d-flex align-items-center" style="{{ ($choice->right) ? "background:green;" : "" }}">
                            <h3 class="h4 mx-auto">{{ $choice->name }}</h3>
                        </div>
                    </div>
                </div>

            @endforeach
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
                            <th>Points</th>
                            <th>Answer</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($question->users as $user)
                            <tr>
                                <td><img src="{{ $user->picture }}" width="70" height="70"></td>
                                <td><a href="{{ url("admin/users/$user->username") }}">{{ $user->name }}</a></td>
                                <td id="pointsPreview{{ $user->id }}">{{ $user->pivot->points }}/{{ $question->points }}</td>
                                <td>
                                    <button class="btn btn-success" data-target="#answer{{ $user->id }}" data-toggle="modal">
                                        View Answer
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="answer{{ $user->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span style="font-weight: bold;">Answer</span>
                                            <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <pre>{{ $question->choices()->find($user->pivot->answer)->name }}</pre>

                                            <label for="points{{ $user->id }}">
                                                Points
                                            </label>
                                            <input max="{{ $question->points }}" min="0" type="number" class="form-control" value="{{ $user->pivot->points }}" name="points{{ $user->id }}" id="points{{ $user->id }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success" data-dismiss="modal" name="saveBtn" id="{{ $user->id }}" username="{{ $user->username }}">Save</button>
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
                var user_id = $(this).attr("id");
                var question_id = '{{ $question->id }}';
                var points = $("#points" + user_id).val();

                $.ajax({
                    url: "{{ url("admin/users/{user}/savePoints") }}".replace("{user}", $(this).attr("username")),
                    type: "POST",
                    data: {_token: "{{ csrf_token() }}", question_id: question_id, points: points},
                    success: function(response) {
                        $("#pointsPreview" + user_id).html(response["points"]);
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
        View Question | StGeorge Thanawy
    </title>
@endsection