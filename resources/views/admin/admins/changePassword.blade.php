@extends("admin.master")

@section('content')
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Change Password</h2>
        </div>
    </header>

    <div class="breadcrumb-holder">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Change Password</li>
        </ul>
    </div>

    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Change Password</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['method'=>"POST", 'url'=>url("admin/change-password")]) !!}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {!! Form::label("old_password", "Old Password *") !!}
                                    {!! Form::password("old_password", ["class" => "form-control", "placeholder" => "Old Password"]) !!}
                                </div>

                                <div class="form-group col-md-6">
                                    {!! Form::label("new_password", "New Password *") !!}
                                    {!! Form::password("new_password", ["class" => "form-control", "placeholder" => "New Password"]) !!}
                                </div>

                                <div class="form-group col-md-6">
                                    {!! Form::label("new_password_confirmation", "New Password Confirmation *") !!}
                                    {!! Form::password("new_password_confirmation", ["class" => "form-control", "placeholder" => "New Password Confirmation"]) !!}
                                </div>
                            </div>

                            <center>{!! Form::submit("Save", ['class' => "btn btn-success"]) !!}</center>
                            {!! Form::close() !!}

                            @include("errors.list")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('title')
    <title>
        Change Password | StGeorge Thanawy
    </title>
@endsection