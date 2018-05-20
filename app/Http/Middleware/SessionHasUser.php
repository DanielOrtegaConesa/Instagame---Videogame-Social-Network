<?php

namespace App\Http\Middleware;

use App\Usuario;
use Closure;

class SessionHasUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->has("usuario")) {
            $ubd = Usuario::where("nick", session("usuario")->nick)->first();
            if (!$ubd->baneado) {
                return $next($request);
            } else {
                session()->flush();
                return redirect("/");
            }
        } else {
            return abort(404);
        }
    }
}
