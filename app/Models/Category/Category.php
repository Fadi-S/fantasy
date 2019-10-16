<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category\Category
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Character\Character[] $characters
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category\Category query()
 * @mixin \Eloquent
 */
class Category extends Model
{
    use CategoryRelationships;
    protected $guarded = [];
    protected $with = ["characters"];

}
