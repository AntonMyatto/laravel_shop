<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if(auth()->check() && auth()->user()->hasRole(...$role))
            return $next($request);
        else
            return response()->redirectToRoute('norole');
    }
}
