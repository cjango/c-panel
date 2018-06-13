<?php

namespace cjango\CPanel\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Guest
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard('cpanel')->check()) {
            return redirect()->route('CPanel.index');
        }

        return $next($request);
    }
}
