<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes, GroupRelationships, GroupMethods;

    protected $fillable = ["name", "slug"];

    public function getRouteKeyName()
    {
        return "slug";
    }

}
