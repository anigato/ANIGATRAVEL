<?php

namespace App\Http\Middleware;

use Closure;

class Operator
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
        if (session('level')=='operator'|session('level')=='admin') {
            return $next($request);
        } else{
            return abort(404);
        }
    }
}
