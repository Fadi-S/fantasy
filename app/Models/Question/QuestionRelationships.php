<?php

namespace App\Models\Question;

use App\Models\Character\Character;
use App\Models\Choice\Choice;
use App\Models\Quiz\Quiz;
use App\Models\User\User;

trait QuestionRelationships
{

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot("answer", "points");
    }

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}