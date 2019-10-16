<?php

namespace App\Models\Character;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Character\Character
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdminLog\AdminLog[] $adminLog
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\User[] $users
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character\Character newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character\Character newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Character\Character onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character\Character query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Character\Character withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Character\Character withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\Category\Category $category
 * @property-read mixed $picture
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question\Question[] $questions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Text\Text[] $texts
 */
class Character extends Model
{
    use SoftDeletes, CharacterRelationships, CharacterAttribute;

    protected $fillable = ["name", "picture", "category_id"];

    // protected $with = ["category"];

}
