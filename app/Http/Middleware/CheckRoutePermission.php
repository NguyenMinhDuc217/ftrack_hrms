<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckRoutePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws \Spatie\Permission\Exceptions\UnauthorizedException
     */
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->guard()->check()) {
            throw UnauthorizedException::notLoggedIn();
        }

        // Get the current route name
        $routeName = $request->route()->getName();

        // no route name => pass
        if (is_null($routeName)) {
             return $next($request);
        }

        // Check if the authenticated user has the permission matching the route name
        if (auth()->guard()->user()->can($routeName)) {
            return $next($request);
        }

        throw UnauthorizedException::forPermissions([$routeName]);
    }
}
