@extends("admin.master")

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Edit '{{ $character->name }}'</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/characters') }}">Characters</a></li>
            <li class="breadcrumb-item"><a href="{{ url("admin/characters/$character->id") }}">{{ $character->name }}</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ul>
    </div>

    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Character</h3>
                        </div>
                        @include("admin.delete", ['what'=>"Character", "url"=> url("admin/characters/$character->id")])
                        <div class="card-body">
                            {!! Form::model($character, ['method'=>"PATCH", 'url'=>url("admin/characters/$character->id"), "files" => true]) !!}
                            @include('admin.characters.form', ['submit' => "Edit Character"])
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
        Edit Character | StGeorge Thanawy
    </title>
@endsection