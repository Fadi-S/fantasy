<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('name', "Name") !!}
        {!! Form::text('name', null, ['class'=>"form-control", "placeholder" => "Name"]) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('dateRange', "Start/End Date") !!}
        {!! Form::text('dateRange', old("dateRange"), ['class'=>"form-control"]) !!}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::hidden('allow_late', 0) !!}
        {!! Form::checkbox('allow_late', 1, null, ['class'=>"checkbox-template", "id"=>"allow_late"]) !!}
        {!! Form::label('allow_late', "Allow Late") !!}

        {!! Form::label('late_penalty', "penalty (From 0 to 1)") !!}
        {!! Form::number('late_penalty', ($create) ? 1: null, ['class'=>"form-control", "step"=>'0.01', 'min'=>"0", 'max'=>1]) !!}
    </div>
    <div class="mx-auto col-md-6">
        {!! Form::hidden('show_answers', 0) !!}
        {!! Form::checkbox('show_answers', 1, null, ['class'=>"checkbox-template", "id"=>"show_answers"]) !!}
        {!! Form::label('show_answers', "Show Answers After Solving") !!}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('group_id', "For Group") !!}
        {!! Form::select('group_id', $groups, null, ['class'=>"form-control"]) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('type_id', "Type") !!}
        @if($create)
            {!! Form::select('type_id', $types, null, ['class'=>"form-control"]) !!}
        @else
            {!! Form::select('type_id', $types, null, ['class'=>"form-control", "disabled"]) !!}
        @endif
    </div>
</div>

<div class="form-group">
    <center>{!! Form::submit($submit, ['class' => "btn btn-success"]) !!}</center>
</div>

@include("errors.list")

{!! Html::script("/js/admin/moment.min.js") !!}
{!! Html::script("/js/admin/daterangepicker.js") !!}
{!! Html::style("/css/admin/daterangepicker.css") !!}

<script>
    $(function() {
        $('input[name="dateRange"]').daterangepicker({
            timePicker: false,
            @if(!old("dateRange"))
            startDate:  "{{ ($create) ? \Carbon\Carbon::now()->format("d/m/Y") : $competition->start->format("d/m/Y") }}",
            endDate: "{{ ($create) ? \Carbon\Carbon::now()->addWeeks(4)->format("d/m/Y") : $competition->end->format("d/m/Y") }}",
            @endif
            locale: {
                format: 'DD/M/YYYY'
            }
        });
    });
</script>