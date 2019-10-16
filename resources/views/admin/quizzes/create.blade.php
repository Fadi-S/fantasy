@extends("admin.master")

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Create Quiz</h2>
    </div>
</header>

<div class="breadcrumb-holder">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('admin/quizzes') }}">Quizzes</a></li>
        <li class="breadcrumb-item active">Create</li>
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
                    <div class="card-body">
                        {!! Form::open(['method'=>"POST", 'url'=>url('admin/quizzes')]) !!}
                            @include('admin.quizzes.form', ['submit' => "Create Quiz", "create" => true])
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
        Create Quiz | StGeorge Thanawy
    </title>
@endsection