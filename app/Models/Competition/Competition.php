<?php

namespace App\Models\Competition;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competition extends Model
{
    use SoftDeletes, CompetitionRelationships;

    protected $fillable = ["name", "slug", "start", "end", "group_id", "type_id"];

    protected $dates = ["start", "end"];

    public function getRouteKeyName()
    {
        return "slug";
    }

}
