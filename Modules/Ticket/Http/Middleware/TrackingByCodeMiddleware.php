<?php

namespace Modules\Ticket\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Ticket\Repositories\TicketRepository;

class TrackingByCodeMiddleware
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
        /** @var TicketRepository $repository */
        $repository = app(TicketRepository::class);
        $code = $request->route()->parameter("code");

        if (!$code)
            throw new \Exception("{code} is not defined in route.");

        if (!$repository->findByCode($code))
            abort(404, "Ticket not found");

        return $next($request);
    }
}
