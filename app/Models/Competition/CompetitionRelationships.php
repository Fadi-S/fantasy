<?php

namespace App\Models\Competition;


use App\Models\AdminLog\AdminLog;
use App\Models\CompetitionType\CompetitionType;
use App\Models\Group\Group;
use App\Models\Quiz\Quiz;
use App\Models\User\User;

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

    public function type()
    {
        return $this->belongsTo(CompetitionType::class, "type_id");
    }

    public function adminLog()
    {
        return $this->morphMany(AdminLog::class, 'logable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'competition_user', 'competition_id', 'user_id')->withPivot("points");
    }

}