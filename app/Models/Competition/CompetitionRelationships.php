<?php

namespace App\Models\Competition;


use App\Models\AdminLog\AdminLog;
use App\Models\Group\Group;
use App\Models\Quiz\Quiz;

trait CompetitionRelationships
{

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function adminLog()
    {
        return $this->morphMany(AdminLog::class, 'logable');
    }

}