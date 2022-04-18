<?php

namespace Modules\Ticket\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\User\Entities\User;
use Modules\User\Utils\Permissions;

class EditTicketMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermission(Permissions::EDIT_TICKET)) return abort(403);
        return $next($request);
    }
}
