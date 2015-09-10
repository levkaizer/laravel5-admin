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
	
	public function hasRoute($route, $key = null) {
		if(\Configuration::has('admin_routes')) {
			$routes = \Admin::routes();
			// limit the search to a particular route group
			if(isset($key)) {
				try {
					$routes = $routes[$key];
					foreach($routes as $k => $r) {
						if(array_key_exists($route, $r)) {
							return true;
						}
					}
				}
				catch(\ErrorException $e) {
					// try general execution
				}
				
			}
			// general execution
			if(isset($routes)) {
				foreach($routes as $k => $r) {
					foreach($r as $key => $foundRoute) {
						if(array_key_exists($route, $foundRoute)) {
							return true;
						}
					}
				}
			}
		}
		return false;
	}

}