<?php

namespace App\Models\Admin;

use App\Models\Competition\Competition;

trait AdminAttributes {

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getPictureAttribute($picture)
    {
        if(is_null($picture) || $picture == '' || !\Storage::exists($picture)) {
            return url("images/defaultPicture.png");
        }
        return url(\Storage::url($picture));
    }

    public function getCompetitionsAttribute()
    {
        $groups = $this->groups;

        $competitionIds = [];

        foreach ($groups as $group)
            $competitionIds = array_merge($group->competitions()->pluck("id")->toArray(), $competitionIds);

        return Competition::whereIn("id", $competitionIds);
    }

}