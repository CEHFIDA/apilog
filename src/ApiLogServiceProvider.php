<?php

namespace Selfreliance\Apilog;

use Illuminate\Support\ServiceProvider;

class ApiLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
        $this->app->make('Selfreliance\Apilog\ApiLogController');
        $this->loadViewsFrom(__DIR__.'/views', 'apilog');
        $this->loadMigrationsFrom(__DIR__.'/migrations');

        $this->publishes([
        	__DIR__.'/middleware/AuthApi.php' => app_path('Http/Middleware/AuthApi.php')
        ], 'middleware');
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    	//
    }    	
}