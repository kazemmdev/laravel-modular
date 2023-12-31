<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // API version 1
            Route::group(['middleware' => 'api', "prefix" => "api/v1", "as" => "api:v1:"], function () {
                Route::group(['as' => 'auth:'], base_path('routes/api/v1/auth.php'));
                Route::group(['as' => 'site:'], base_path('routes/api/v1/site.php'));
                Route::group(['as' => 'admin:', "prefix" => "manage"], base_path('routes/api/v1/manage.php'));
            });
        });
    }
}
