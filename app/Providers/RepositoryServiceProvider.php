<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\Interface\OrderRepositoryInterface', 'App\Services\Action\OrderRepository');
        $this->app->singleton('App\Services\Interface\SettingRepositoryInterface', 'App\Services\Action\SettingRepository');
        $this->app->singleton('App\Services\Interface\AuthRepositoryInterface', 'App\Services\Action\AuthRepository');
        $this->app->singleton('App\Services\Interface\PayRepositoryInterface', 'App\Services\Action\PayRepository');
        $this->app->singleton('App\Services\Interface\GatewayRepositoryInterface', 'App\Services\Action\GatewayRepository');
    }
   

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
