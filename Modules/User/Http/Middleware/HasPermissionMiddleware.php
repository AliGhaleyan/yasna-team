<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        dd($permission);
        return $next($request);
    }
}
