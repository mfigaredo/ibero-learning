<?php

namespace App\Http\Middleware;

use Closure;
use Barryvdh\Debugbar\Facade as Debugbar;

class NoDebugbar
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
        Debugbar::disable();
        return $next($request);
    }
}
