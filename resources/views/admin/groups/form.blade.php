<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('name', "Name") !!}
        {!! Form::text('name', null, ['class'=>"form-control", "placeholder" => "Name"]) !!}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('admins[]', "5odam") !!}
        {!! Form::select('admins[]', $admins, null, ['class'=>"form-control", "id" => "adminsSelect", "multiple"=>"multiple"]) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('years[]', "Years") !!}
        {!! Form::select('years[]', $years, null, ['class'=>"form-control", "id" => "yearsSelect", "multiple"=>"multiple"]) !!}
    </div>
</div>


<div class="form-group">
    <center>{!! Form::submit($submit, ['class' => "btn btn-success"]) !!}</center>
</div>

@include("errors.list")

{!! Html::script("js/admin/jquery.multi-select.js") !!}
{!! Html::style("css/admin/multi-select.dist.css") !!}

<script>
    $('#adminsSelect').multiSelect();
    $('#yearsSelect').multiSelect();
</script>