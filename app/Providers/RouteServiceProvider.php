<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = 'admin/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            $adminRoutes = [
                'subjects.php',
                'result.php',
                'students.php',
                'class.php',
                'questions.php',
                'blocks.php',
                'levels.php',
                'exams.php',
                'blogs.php',
                'permissions.php',
                'roles.php',
                'users.php',
                'infos.php',
                'home.php',
            ];

            Route::middleware('web')->group(function () use ($adminRoutes) {
                require base_path('routes/web.php');
                
                foreach ($adminRoutes as $route) {
                    require base_path("routes/admin/{$route}");
                }
            });
        });
    }
}
