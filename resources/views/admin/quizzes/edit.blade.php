@extends("admin.master")

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Edit '{{ $quiz->name }}'</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/groups') }}">Groups</a></li>
            <li class="breadcrumb-item"><a href="{{ url("admin/groups/" . $quiz->competition->group->slug) }}">{{ $quiz->competition->group->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/competitions') }}">Competitions</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/competitions/' . $quiz->competition->slug) }}">{{ $quiz->competition->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url("admin/quizzes/$quiz->id") }}">{{ $quiz->name }}</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ul>
    </div>

    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Quiz</h3>
                        </div>
                        @include("admin.delete", ['what'=>"Quiz", "url"=> url("admin/quizzes/$quiz->id")])
                        <div class="card-body">
                            {!! Form::model($quiz, ['method'=>"PATCH", 'url'=>url("admin/quizzes/$quiz->id")]) !!}
                            @include('admin.quizzes.form', ['submit' => "Edit Quiz", "create" => false])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('title')
    <title>
        Edit Quiz | StGeorge Thanawy
    </title>
@endsection