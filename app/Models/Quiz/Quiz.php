<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Quiz\Quiz
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdminLog\AdminLog[] $adminLog
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question\Question[] $questions
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quiz\Quiz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quiz\Quiz newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Quiz\Quiz onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quiz\Quiz query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Quiz\Quiz withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Quiz\Quiz withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Character\Character[] $characters
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\User[] $solvers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Text\Text[] $texts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\User[] $users
 */
class Quiz extends Model
{
    use SoftDeletes, QuizRelationships;

    protected $dates = ["start_date", "end_date"];

    protected $fillable = ["name", "start_date", "end_date", "max_minutes", "competition_id"];
}
