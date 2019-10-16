<?php

namespace App\Models\Category;


use App\Models\Character\Character;

trait CategoryRelationships
{

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

}