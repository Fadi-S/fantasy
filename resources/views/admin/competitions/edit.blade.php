@extends("admin.master")

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Edit '{{ $competition->name }}'</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/groups') }}">Groups</a></li>
            <li class="breadcrumb-item"><a href="{{ url("admin/groups/" . $competition->group->slug) }}">{{ $competition->group->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/competitions') }}">Competitions</a></li>
            <li class="breadcrumb-item"><a href="{{ url("admin/competitions/$competition->slug") }}">{{ $competition->name }}</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ul>
    </div>

    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Competition</h3>
                        </div>
                        @include("admin.delete", ['what'=>"Competition", "url"=> url("admin/competitions/$competition->slug")])
                        <div class="card-body">
                            {!! Form::model($competition, ['method'=>"PATCH", 'url'=>url("admin/competitions/$competition->slug")]) !!}
                            @include('admin.competitions.form', ['submit' => "Edit Competition", "create" => false])
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
        Edit Competition | StGeorge Thanawy
    </title>
@endsection