<?php

namespace App\Http\Middleware;

use Closure;

class SessionHasAdmin
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
        if(session()->has("admin")) {
            return $next($request);
        }
        else{
            return abort(404);
        }
    }
}
