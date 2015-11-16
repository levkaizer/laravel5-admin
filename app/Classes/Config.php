<?php

namespace App\Classes;

class Config {
	
	public function get($key) {
		$val = \App\Config::where('key', $key)->pluck('value');
		\Debugbar::info($key .' : '. $val);
		$val = unserialize($val);
		return $val;
	}
	
	public function set($key, $val) {
		$config = \App\Config::firstOrNew(['key' => $key]);
		$config->value = serialize($val);
		$config->save();
	}
	
	public function has($key) {
		$count = \App\Config::where('key', $key)->count();
		if($count > 0) {
			return true;
		}
		return false;
	}
	
	public function delete($key) {
		\App\Config::where('key', $key)->delete();
	}
	
	public function debug() {
		return $this->get('debug');
	}
	
	public function installed() {
		return $this->get('installed');
	}
	
}