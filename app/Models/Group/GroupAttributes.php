<?php

namespace App\Models\Group;


use Carbon\Carbon;

trait GroupAttributes
{

    public function getCurrentCompetitionAttribute()
    {
        $now = Carbon::now();

         return $this
            ->competitions()
            ->where([["start", "<=", $now->toDateString()], ["end", ">=", $now->toDateString()]])
            ->first();
    }

}