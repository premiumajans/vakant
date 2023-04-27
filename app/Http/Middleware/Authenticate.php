<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        if ($request->routeIs('backend.*')) {
            return route('backend.login');
        }

        if ($request->routeIs('user.*')) {
            return route('backend.login');
        }
        return null;
    }
}
