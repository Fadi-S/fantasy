<?php

namespace App\Models\Year;

use App\Models\Group\Group;
use App\Models\User\User;

trait YearRelationships
{

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}