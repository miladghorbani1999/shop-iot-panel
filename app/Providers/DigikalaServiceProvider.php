<?php

namespace App\Providers;

use App\Services\DigikalaAdaptee\DigikalaAdapter;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class DigikalaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $this->app->instance('digikala', app()->make('App\Services\DigikalaAdaptee\DigikalaAdapter'));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
