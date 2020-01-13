@extends("admin.master")

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Edit</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/groups') }}">Groups</a></li>
            <li class="breadcrumb-item"><a href="{{ url("admin/groups/" . $text->quiz->competition->group->slug) }}">{{ $text->quiz->competition->group->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/competitions') }}">Competitions</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/competitions/' . $text->quiz->competition->slug) }}">{{ $text->quiz->competition->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url("admin/quizzes/" . $text->quiz->id) }}">{{ $text->quiz->name }}</a></li>
            <li class="breadcrumb-item active">Edit {{ $text->name }}</li>
        </ul>
    </div>

    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Shahed</h3>
                        </div>
                        @include("admin.delete", ['what'=>"Shahed", "url"=> url("admin/texts/$text->id")])
                        <div class="card-body">
                            {!! Form::model($text, ['method'=>"PATCH", 'url'=>url("admin/texts/$text->id")]) !!}
                            @include('admin.texts.form', ['submit' => "Edit Shahed", "create" => false])
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
        Edit Shahed | StGeorge Thanawy
    </title>
@endsection