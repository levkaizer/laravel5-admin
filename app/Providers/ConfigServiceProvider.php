<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    	if(\Schema::hasTable('config')) {
    		if(!\Configuration::has('app_name')) {
    			\Configuration::set('app_name', env('APP_NAME'));
    		}
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
