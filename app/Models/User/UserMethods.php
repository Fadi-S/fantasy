<?php

namespace App\Models\User;

use Carbon\Carbon;

trait UserMethods
{
    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->api_token_time = Carbon::now();
        $this->save();

        return $this->api_token;
    }

    public function generateRefreshToken()
    {
        $token = str_random(60);
        $this->refresh_token = $token;
        $this->save();

        return $token;
    }
}