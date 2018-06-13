<?php

namespace cjango\CPanel\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{

    public function handle($request, Closure $next)
    {
        if (Auth::guard('cpanel')->guest()) {
            return redirect()->route('CPanel.login');
        }
        return $next($request);
    }
}
