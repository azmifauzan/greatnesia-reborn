<?php

namespace App\Http\Middleware;

use Closure;

class Authadmin
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
        if (!$request->session()->exists('email')) {
            return redirect()->route('loginadmin');
        }
        return $next($request);
    }
}
