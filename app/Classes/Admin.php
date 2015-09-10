<?php

namespace App\Classes;

class Admin {
	
	public function routes() {
		$routes = array();
		if(\Configuration::has('admin_routes')) {
			$routes = \Configuration::get('admin_routes');
		}
		return (is_array($routes) && count($routes)) ? $routes : array();
	}
	
	public function addRoute($route = array(), $key = '') {
		if(count($route) > 0) {
			$keys = array_keys($route);
			$currentRoutes = \Admin::routes();
			 if(!array_key_exists($keys[0], $currentRoutes)) {
				$currentRoutes[$key][] = $route;
				\Configuration::set('admin_routes', $currentRoutes);
				return true;
			}
		}
		return false;
	}
	
	
}