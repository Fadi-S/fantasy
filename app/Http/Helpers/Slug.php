<?php

namespace App\Http\Helpers;

class Slug
{
    public static function createSlug($model, $sep, $title, $slugName='slug', $id = 0)
    {
        $slug = strtolower(str_replace(" ", $sep, $title));

        $allSlugs = self::getRelatedSlugs($model, $slug, $slugName, $id);

        if (! $allSlugs->contains($slugName, $slug))
            return $slug;

        $i = 1;
        while (true) {
            $newSlug = $slug . $i;
            if (! $allSlugs->contains($slugName, $newSlug))
                return $newSlug;
            $i++;
        }
        return null;
    }

    public static function make_slug($string, $separator = '-')
    {
        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');

        $string = preg_replace("/[^a-z0-9_\s\-ءاآؤئبپتثجچحخدذرزژسشىصضطظعغفقكکگلمنوهیأي]/u", '', $string);

        $string = preg_replace("/[\s\-_]+/", ' ', $string);

        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }

    protected static function getRelatedSlugs($model, $slug, $slugName='slug', $id = 0)
    {
        $r = new \ReflectionClass($model);
        $model = $r->newInstanceWithoutConstructor();
        return $model->select($slugName)
            ->where($slugName, 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}