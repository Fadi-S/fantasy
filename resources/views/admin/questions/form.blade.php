<div id="app" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="h4">Question</h3>
            <button type="button" v-on:click="addChoice" class="btn btn-primary ml-auto">Add Choice</button>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    {!! Form::label('quiz_id', "Quiz") !!}
                    {!! Form::select('quiz_id', $quizzes, null, ['class'=>"form-control"]) !!}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('character_id', "Character") !!}
                    {!! Form::select('character_id', $characters, null, ['class'=>"form-control", "dir" => "rtl"]) !!}
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('points', "Maximum Points") !!}
                    {!! Form::number('points', null, ['class'=>"form-control", "placeholder" => "Points"]) !!}
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    {!! Form::label('body', "Question") !!}
                    {!! Form::textarea('body', null, ['class'=>"form-control", "placeholder" => "السؤال", "dir" => "rtl"]) !!}
                </div>
            </div>

            <div class="form-group">
                <center>{!! Form::submit($submit, ['class' => "btn btn-success"]) !!}</center>
            </div>

            @include("errors.list")
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4" v-for="choice in choices">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4" v-html="'Choice ' + choice.id"></h3>
                    <button type="button" v-on:click="removeChoice(choice)" class="btn btn-danger ml-auto">&times;</button>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <input type="hidden" :name="'choices[' + choice.id + '][id]'" :value="choice.id">
                        <div class="form-group col-md-6">
                            {!! Form::label(null, "Name", [":for" => "'choices[' + choice.id + '][name]'"]) !!}
                            {!! Form::text(null, null, ["class" => "form-control", "placeholder" => "Name", ":name" => "'choices[' + choice.id + '][name]'", ":id" => "'choices[' + choice.id + '][name]'", ":value"=>"choice.name"]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label("right", "Right") !!}
                            {!! Form::radio("right", null, null, ["class" => "form-control", ":value" => "choice.id", ":checked" => "(choice.right == 1)"]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Html::script("/js/vue.min.js") !!}

<script>
    window.vue = new Vue({
        el: "#app",

        data: {
            choices: @if($create) {!! (!empty(old("choices"))) ? json_encode(array_values(old("choices"))) : "[]" !!} @else {!! (!empty(old("choices"))) ? json_encode(array_values(old("choices"))) : $question->choices()->get()->toJSON() !!} @endif,
            last: 0
        },

        created: function () {
            this.last = (-1) * this.choices.length;
        },

        methods: {
            addChoice() {
                this.last -= 1;
                this.choices.push({
                    id: this.last,
                    name: ""
                });
            },
            removeChoice(choice) {
                this.choices.splice( this.choices.indexOf(choice), 1 );
            }
        }
    });
</script>