<div class="form-row">
    <div class="form-group col-md-4">
        {!! Form::label('name', "Shahed") !!}
        {!! Form::text('name', null, ['class'=>"form-control", "placeholder" => "الشاهد", "dir" => "rtl"]) !!}
    </div>

    <div class="form-group col-md-4">
        {!! Form::label('character_id', "Character") !!}
        {!! Form::select('character_id', $characters, null, ['class'=>"form-control"]) !!}
    </div>

    <div class="form-group col-md-4">
        {!! Form::label('quiz_id', "Quiz") !!}
        {!! Form::select('quiz_id', $quizzes, null, ['class'=>"form-control"]) !!}
    </div>
</div>

<div class="form-group">
    <center>{!! Form::submit($submit, ['class' => "btn btn-success"]) !!}</center>
</div>

@include("errors.list")