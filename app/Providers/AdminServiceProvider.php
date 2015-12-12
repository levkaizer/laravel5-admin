<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    	if(\Schema::hasTable('config')) {
    		if(!\Configuration::has('admin_routes')) {
    			\Admin::addRoute(['Admin info' => array('link' => route('admin::info'), 'attributes' => array('class' => 'admin-link'))], 'Help');
    			\Admin::addRoute([
    				'Theme' => array('link' => route('admin::themes'), 'attributes' => array('class' => 'admin-link')),
    				'CSS Editor' => array('link' => route('admin::css'), 'attributes' => array('class' => 'admin-link'))
    				], 'Look & Feel');
    			\Admin::addRoute(['View users' => array('link' => route('admin::users'), 'attributes' => array('class' => 'admin-link'))], 'User Management');
    			\Admin::addRoute([
    				'View lists' => array('link' => route('admin::lists'), 'attributes' => array('class' => 'admin-link')),
    				'Choose default list' => array('link' => route('admin::list-default'), 'attributes' => array('class' => 'admin-link'))
    				], 'Mailing lists');
    			\Admin::addRoute([
    				'Add content' => array('link' => route('admin::add-content'), 'attributes' => array('class' => 'admin-link')),
    				'List content' => array('link' => route('admin::list-content'), 'attributes' => array('class' => 'admin-link')),
    				], 'Content');
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
        \App::bind('admin', function()
        {
        	// set debug mode!
        	if(!\Configuration::has('debug')) {
        		\Configuration::set('debug', true);
        	}
            return new \App\Classes\Admin;
        });
    }
}
