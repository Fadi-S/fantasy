<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('name', "Name") !!}
        {!! Form::text('name', null, ['class'=>"form-control", "placeholder" => "Name"]) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('max_minutes', "Maximum Time (in minutes)") !!}
        {!! Form::number('max_minutes', null, ['class'=>"form-control", "placeholder" => "Maximum Time (in minutes)"]) !!}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('dateRange', "Start/Deadline Date") !!}
        {!! Form::text('dateRange', old("dateRange"), ['class'=>"form-control"]) !!}
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
            timePicker: true,
            @if(!old("dateRange"))
            startDate:  "{{ ($create) ? \Carbon\Carbon::now()->format("d/m/Y h:i A") : $quiz->start_date->format("d/m/Y h:i A") }}",
            endDate: "{{ ($create) ? \Carbon\Carbon::now()->addHours(2)->format("d/m/Y h:i A") : $quiz->end_date->format("d/m/Y h:i A") }}",
            @endif
            locale: {
                format: 'DD/M/YYYY hh:mm A'
            }
        });
    });
</script>