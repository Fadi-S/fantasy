<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Question\Question
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question\Question query()
 * @mixin \Eloquent
 * @property-read \App\Models\Character\Character $character
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Choice\Choice[] $choices
 * @property-read \App\Models\Quiz\Quiz $quiz
 */
class Question extends Model
{
    use QuestionRelationships;

    protected $guarded = [];
    protected $with = ["choices"];

}
