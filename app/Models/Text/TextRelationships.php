<?php

namespace App\Models\Text;


use App\Models\Character\Character;
use App\Models\Quiz\Quiz;

trait TextRelationships
{

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

}