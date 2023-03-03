<?php

namespace Human018\LaravelAusPost\Providers;

use Human018\LaravelEarth\Commands\EarthInit;
use Illuminate\Support\ServiceProvider;

class LaravelAusPostServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/services.php', 'services'
        );
    }

}
