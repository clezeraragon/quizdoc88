<?php

namespace DockQuiz\Http\Middleware;

use Closure;
use DockQuiz\User;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        return $next($request);
    }
}
