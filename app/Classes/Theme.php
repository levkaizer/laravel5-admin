<?php

namespace App\Classes;

class Theme {
	
	public function display($viewLocation, $viewData) {
		$theme = \Configuration::get('theme');
		if($theme != '0') {
			return view('theme/'.$theme.'/'.$viewLocation, $viewData);
		}
		// if default theme is set or theme file is not implemented, fall back to original.
		return view($viewLocation, $viewData);
	}
	
	public function lists() {
		$dir = base_path('resources/views/theme');
		$scanned_directory = array_diff(scandir($dir), array('..', '.'));
		return $scanned_directory;

	}
	
	public function getCSS() {
		$fileData = array();
    	$css = null;
    	$fileName = public_path().'/front.css';
    	if(file_exists($fileName)) {
    		$css = file_get_contents($fileName);
    	}
    	$fileData['path'] = $fileName;
    	$fileData['css' ] = $css;
    	return $fileData;
	}
	
}