<?php

namespace App\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class ShopServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $this->app->instance('shop', app()->make('App\Services\Shop\Shop'));

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
