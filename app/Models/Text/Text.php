<?php

namespace App\Models\Text;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Text\Text
 *
 * @property-read \App\Models\Character\Character $character
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Text\Text newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Text\Text newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Text\Text query()
 * @mixin \Eloquent
 * @property-read \App\Models\Quiz\Quiz $quiz
 */
class Text extends Model
{
    use TextRelationships;

    protected $guarded = [];

}
