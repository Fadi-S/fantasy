@extends("admin.master")

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Create Group</h2>
    </div>
</header>

<div class="breadcrumb-holder">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('admin/groups') }}">Groups</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ul>
</div>

<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Group</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['method'=>"POST", 'url'=>url('admin/groups')]) !!}
                            @include('admin.groups.form', ['submit' => "Create Group"])
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
        Create Group | StGeorge Thanawy
    </title>
@endsection