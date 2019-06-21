<?php

namespace App\Http\Middleware;
use Closure;
use App\Services\CheckAuth ;

class CheckAuthKey 
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
        $user = new CheckAuth($request);
        $auth = $user->validateUser();
        if(json_decode($auth)!=JSON_ERROR_NONE){
            return $next($request);
        }
        return $auth;
    }
}
