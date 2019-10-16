<?php

namespace App\Models\User;

use App\Models\AdminLog\AdminLog;
use App\Models\Character\Character;
use App\Models\Question\Question;
use App\Models\Quiz\Quiz;

trait UserRelationships
{

    public function adminLog()
    {
        return $this->morphMany(AdminLog::class, 'logable');
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }

    public function solvedQuizzes()
    {
        return $this->belongsToMany(Quiz::class)->withPivot("started_at", "ended_at");
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withPivot('points', 'answer');
    }
}
