<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if(!$request->user()->hasRole($permission)) {
            abort(403);
        }
//        if($permission !== null && !$request->user()->can($permission)) {
//            abort(403);
//        }

        return $next($request);
    }
}
