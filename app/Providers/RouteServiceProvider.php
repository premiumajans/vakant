<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = 'admin/dashboard';
    public const USER = 'user/profile';


    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

//            Route::middleware(['web', 'frontLanguage'])
//                ->group(base_path('routes/web.php'));

//            Route::middleware('frontLanguage')
//                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'backendLanguage'])
                ->prefix('/')
                ->name('backend.')
                ->group(base_path('routes/web/backend.php'));
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
