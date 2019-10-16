<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('name', "Name") !!}
        {!! Form::text('name', null, ['class'=>"form-control", "placeholder" => "Name"]) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('image', "Picture") !!}
        {!! Form::file('image', ['class'=>"form-control", "accept"=>"image/*"]) !!}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('category_id', "Category") !!}
        {!! Form::select('category_id', $categories, null, ['class'=>"form-control"]) !!}
    </div>
</div>

<div class="form-group">
    <center>{!! Form::submit($submit, ['class' => "btn btn-success"]) !!}</center>
</div>

@include("errors.list")