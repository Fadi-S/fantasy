<?php

namespace App\Models\Year;

use App\Models\Group\Group;

trait YearRelationships
{

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}