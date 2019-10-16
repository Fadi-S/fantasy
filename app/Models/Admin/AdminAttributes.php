<?php

namespace App\Models\Admin;

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

}