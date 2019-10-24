<?php

namespace App\Models\Group;


use Carbon\Carbon;

trait GroupAttributes
{

    public function getCurrentCompetitionAttribute()
    {
        $now = Carbon::now()->toDateString();

         return $this
            ->competitions()
            ->where([["start", "<=", $now], ["end", ">=", $now]])
            ->first();
    }

}