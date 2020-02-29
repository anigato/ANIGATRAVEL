<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class AuthUser
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

        if (session()->has('username')) {
            if (User::where('username',session('username'))) {
                return $next($request);
            }
            return redirect()->route('cc');
        }
        return redirect()->route('cc');
    }
}
