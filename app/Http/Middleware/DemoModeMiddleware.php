<?php

namespace App\Http\Middleware;

use App\Exceptions\ActionNotAllowedInDemo;
use Closure;
use Illuminate\Http\Request;

class DemoModeMiddleware
{

    private array $ignoredRoutes = [
        'logout',
        'admin.doLogin'
    ];

    public function handle(Request $request, Closure $next)
    {
        if ($request->method() !== "GET" && !in_array($request->route()?->getName(), $this->ignoredRoutes, true) && app()->environment('demo')) {
            $error = new ActionNotAllowedInDemo();
            report($error);
            return redirect()
                ->back()
                ->withErrors($error->getMessage());
        }
        return $next($request);
    }
}
