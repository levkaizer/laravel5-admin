<?php

namespace App\Classes;

class Theme {
	
	public function display($viewLocation, $viewData) {
		return view('theme/strap/'.$viewLocation, $viewData);
	}
	
	public function lists() {
		$dir = base_path('resources/views/theme');
		$scanned_directory = array_diff(scandir($dir), array('..', '.'));
		return $scanned_directory;

	}
	
}