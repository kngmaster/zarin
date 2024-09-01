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
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
       
    }

    

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

     /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
        $this->mapApiV1AuthRoutes();
        $this->mapApiV1UserRoutes();
        $this->mapApiV1TaskRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapApiV1AuthRoutes()
    {
        $this->configureRateLimiting();

        Route::prefix('api/v1/auth')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/auth.php'));
    }

    protected function mapApiV1UserRoutes()
    {
        $this->configureRateLimiting();

        Route::prefix('api/v1/user')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/user.php'));
    }

    protected function mapApiV1TaskRoutes()
    {
        $this->configureRateLimiting();

        Route::prefix('api/v1/task')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/task.php'));
    }

}
