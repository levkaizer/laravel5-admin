<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    	if(!\Configuration::has('app_name')) {
    		\Configuration::set('app_name', env('APP_NAME'));
    	}
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \App::bind('configuration', function()
        {
            return new \App\Classes\Config;
        });
    }
}
