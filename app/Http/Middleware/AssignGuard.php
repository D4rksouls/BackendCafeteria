<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AssignGuard
{
    /**
     *  Valida el el guard no sea nulo y asigna el guard
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($guard != null)
            auth()->shouldUse($guard);
        return $next($request);
    }
}
