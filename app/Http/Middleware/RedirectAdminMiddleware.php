<?php

namespace App\Http\Middleware;

use Closure;

class RedirectAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user() && auth()->user()->admin) {
            return redirect()->route('admin');
        }

        return $next($request);
    }
}
