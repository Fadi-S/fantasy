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
            <li class="breadcrumb-item"><a href="{{ url("admin/questions/$question->id") }}">Question</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ul>
    </div>

    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                @include("admin.delete", ['what'=>"Question", "url"=> url("admin/questions/$question->id")])

                <div class="col-lg-12">
                    {!! Form::model($question, ['method'=>"PATCH", 'url'=>url("admin/questions/$question->id")]) !!}
                    @include('admin.questions.form', ['submit' => "Edit Question", "create" => false])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('title')
    <title>
        Edit Question | StGeorge Thanawy
    </title>
@endsection