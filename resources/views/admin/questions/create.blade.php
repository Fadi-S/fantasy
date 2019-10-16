@extends("admin.master")

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Create Question</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Create Question</li>
        </ul>
    </div>

    <section class="forms">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    {!! Form::open(['method'=>"POST", 'url'=>url('admin/questions')]) !!}
                    @include('admin.questions.form', ['submit' => "Create Question", "create" => true])
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </section>
@endsection

@section('title')
    <title>
        Create Question | StGeorge Thanawy
    </title>
@endsection