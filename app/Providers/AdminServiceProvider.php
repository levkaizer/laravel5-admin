<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    	if(!\Configuration::has('admin_routes')) {
    		\Admin::addRoute(['Admin info' => array('link' => route('admin::info'), 'attributes' => array('class' => 'admin-link'))], 'Help');
    	}
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \App::bind('admin', function()
        {
            return new \App\Classes\Admin;
        });
    }
}
