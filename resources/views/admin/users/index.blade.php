@extends('admin.master')

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Users</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ul>
    </div>

    <div class="col-12">
        <a class="btn btn-success" href="{{ url("admin/users/create") }}">Create User</a>
        <a class="btn btn-primary mr-auto" href="{{ url("admin/users/calculate") }}">Calculate Points For Current Competition</a>
        <br><br>

        <div class="row">
            @foreach(auth("admin")->user()->groups as $group)
                @if($group->current_competition != null)
                    <div class="col-6">
                        <div class="card">

                            <div class="card-header d-flex align-items-center">
                                <h3 class="h4">{{ $group->name }}</h3>
                            </div>

                            <div class="card-body">
                                Current Competition:
                                <a href="{{ url("admin/competitions/" . $group->current_competition->slug) }}">
                                    {{ $group->current_competition->name }}
                                </a>
                            </div>

                        </div>
                    </div>
                @endif
            @endforeach
        </div>


        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">All Users Table</h3>
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
                                <th>Unsolved Questions</th>
                                <th>Correct / Total Questions</th>
                                <th>Wrong / Total Questions</th>
                                <th>Percentage</th>
                                <th>View</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <?php
                                    $competition = $user->group->current_competition;
                                    $totalQuestions = $user->totalQuestionsInCompetition($competition);
                                    $percentage = $user->correctToTotalQuestionsPercentage($competition);
                                    $wrong_percentage = $user->wrongToTotalQuestionsPercentage($competition);
                                ?>
                                <tr>
                                    <td><img src="{{ $user->picture }}" width="70"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->group->name }}</td>
                                    <td>{{ $user->year->name }}</td>
                                    <td>{{ $user->points }}</td>
                                    <td>{{ $user->unsolvedQuestionsInCompetition($competition) }}</td>
                                    <td>{{ $user->totalCorrectQuestionsInCompetition($competition) . "/" . $totalQuestions }}</td>
                                    <td>{{ $user->totalWrongQuestionsInCompetition($competition) . "/" . $totalQuestions }}</td>
                                    <td>
                                        <div class="progress mx-auto" style="height: 20px">
                                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                                 style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                                {{ $percentage }}%
                                            </div>
                                        </div>
                                        <br>
                                        <div class="progress mx-auto" style="height: 20px; color:black;">
                                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                                 style="width: {{ $wrong_percentage }}%" aria-valuenow="{{ $wrong_percentage }}" aria-valuemin="0" aria-valuemax="100">
                                                {{ $wrong_percentage }}%
                                            </div>
                                        </div>
                                        </td>
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

@endsection

@section("title")
    <title>All Users | StGeorge Thanawy</title>
@endsection