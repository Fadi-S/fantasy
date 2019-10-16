<?php

namespace App\Models\User;

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
        return $this->questions()->sum('question_user.points');
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