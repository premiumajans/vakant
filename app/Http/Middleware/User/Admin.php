<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('web')->check()) {
            return redirect(route('backend.login'));
        }
        return $next($request);
    }
}
