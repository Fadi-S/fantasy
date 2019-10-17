<?php

namespace App\Models\User;

use App\Models\Competition\Competition;

trait UserAttributes
{
    public function setRefreshTokenAttribute($token)
    {
        $this->attributes['refresh_token'] = bcrypt($token);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucwords(strtolower($name));
    }

    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = strtolower($email);
    }

    public function getPictureAttribute($picture)
    {
        if(is_null($picture) || $picture == '' || !\Storage::exists('public/photos/users/' . $picture)) {
            return url("images/defaultPicture.png");
        }
        return url(\Storage::url('public/photos/users/' . $picture));
    }

    public function getPointsAttribute()
    {
        $curCompetition = $this->group->current_competition;

        if($curCompetition == null) return 0;

        return $this->questions()->whereHas('quiz', function($query) use ($curCompetition) {
            $query->where("competition_id", $curCompetition->id);
        })->sum('question_user.points');
    }

    public function getNameAttribute($name)
    {
        return ucwords(strtolower($name));
    }

    public function getEmailAttribute($email)
    {
        return strtolower($email);
    }
}