<?php

namespace App\Models\Character;


trait CharacterAttribute
{

    public function getPictureAttribute($picture)
    {
        if(is_null($picture) || $picture == '' || !\Storage::exists('public/photos/characters/' . $picture)) {
            return url("images/defaultPicture.png");
        }

        return url(\Storage::url('public/photos/characters/' . $picture));
    }

}