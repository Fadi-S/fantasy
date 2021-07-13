<?php

namespace App\Http\Middleware;

use Closure;

class SecureConnection
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
//        if (app()->environment() == 'production') {
//            if (!$request->secure() || !starts_with($request->header('host'), 'thanawy.')) {
//                if(!starts_with($request->header('host'), 'thanawy.'))
//                    $request->headers->set('host', 'thanawy.' . $request->header('host'));
//
//                return \Redirect::to(str_replace("http://", 'https://', $request->fullUrl()), 302);
//            }
//        }


        /*if ($request->secure() || !starts_with($request->header('host'), 'thanawy.')) {
            if(!starts_with($request->header('host'), 'thanawy.'))
                $request->headers->set('host', 'thanawy.' . $request->header('host'));

            return \Redirect::to(str_replace("https://", 'http://', $request->fullUrl()), 302);
        }*/

        return $next($request);
    }
}
