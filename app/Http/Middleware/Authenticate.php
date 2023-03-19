<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (str_contains($request->getRequestUri(), 'user')) {
                return route('user.loginForm');
            }
            if (str_contains($request->getRequestUri(), 'admin')) {
                return route('login');
            }
        }
//        if (!$request->expectsJson()) {
//            return route('login');
//        }
    }
}
