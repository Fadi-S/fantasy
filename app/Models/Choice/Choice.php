<?php

namespace App\Models\Choice;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Choice\Choice
 *
 * @property-read \App\Models\Question\Question $question
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Choice\Choice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Choice\Choice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Choice\Choice query()
 * @mixin \Eloquent
 */
class Choice extends Model
{
    use ChoiceRelationships;
    protected $guarded = [];
    protected $hidden = ["right"];

}
