<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'api/auth/login*',
        'api/auth/register*',
        'api/auth/change-password*',
        'api/auth/refresh*',
        'api/auth/logout*',
        'api/vacancies/store*',
        'api/vacancies/{id}/update*',
        'api/auth/forgot-password*',

//        'api/auth/login*',
//        'api/auth/login*',
//        'api/auth/login*',
    ];
}
