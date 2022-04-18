<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next)
    {
        $lang = request()->segment(2);
        if (!in_array($lang, config("app.support_locales", ["en"])))
            throw new \Exception("Lang {$lang} not supported");

        app()->setLocale($lang);
        $request->route()->forgetParameter("locale");
        return $next($request);
    }
}
