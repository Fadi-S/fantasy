<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('name', "Name") !!}
        {!! Form::text('name', null, ['class'=>"form-control", "placeholder" => "Name"]) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('email', "Email") !!}
        {!! Form::email('email', null, ['class'=>"form-control", "placeholder" => "Email"]) !!}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('password', "Password") !!}
        {!! Form::password('password', ['class'=>"form-control", "placeholder" => "Password"]) !!}
    </div>
</div>

<div class="form-group">
    <center>{!! Form::submit($submit, ['class' => "btn btn-success"]) !!}</center>
</div>

@include("errors.list")