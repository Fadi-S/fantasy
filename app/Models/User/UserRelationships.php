<?php

namespace App\Models\User;

use App\Models\AdminLog\AdminLog;
use App\Models\Character\Character;
use App\Models\Competition\Competition;
use App\Models\Group\Group;
use App\Models\Question\Question;
use App\Models\Quiz\Quiz;
use App\Models\Year\Year;

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

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function solvedQuizzes()
    {
        return $this->belongsToMany(Quiz::class)->withPivot("started_at", "ended_at");
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withPivot('points', 'answer');
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function quizzes()
    {
        return $this->belongsToMany(User::class, "character_user", "user_id", "quiz_id");
    }

    public function competitions()
    {
        return $this->belongsToMany(Competition::class, 'competition_user', 'user_id', 'competition_id')->withPivot("points");
    }
}
