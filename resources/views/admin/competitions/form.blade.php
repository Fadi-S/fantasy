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
        {!! Form::label('group_id', "For Group") !!}
        {!! Form::select('group_id', $groups, null, ['class'=>"form-control"]) !!}
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