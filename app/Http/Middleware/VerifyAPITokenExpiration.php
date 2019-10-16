<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class VerifyAPITokenExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user('api');
        if(!is_null($user)) {
            if (Carbon::now()->greaterThanOrEqualTo($user->api_token_time->addHours(6)))
                return response(["error" => "API Token Expired."], 408);
        }else{
            return response(["error" => "API Token Expired."], 408);
        }

        return $next($request);
    }
}
