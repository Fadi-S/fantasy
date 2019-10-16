<?php

namespace App\Models\Quiz;


use App\Models\AdminLog\AdminLog;
use App\Models\Character\Character;
use App\Models\Question\Question;
use App\Models\Text\Text;
use App\Models\User\User;

trait QuizRelationships
{

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class, "character_user", "quiz_id", "character_id")->withPivot("captain");
    }

    public function texts()
    {
        return $this->hasMany(Text::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "character_user", "quiz_id", "user_id");
    }

    public function solvers()
    {
        return $this->belongsToMany(User::class)->withPivot("started_at", "ended_at");
    }

    public function adminLog()
    {
        return $this->morphMany(AdminLog::class, 'logable');
    }

}