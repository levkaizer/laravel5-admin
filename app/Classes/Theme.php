<?php

namespace App\Classes;

class Theme {
	private $view;
	public function display($viewLocation, $viewData, $cookieData = null) {
		$theme = \Configuration::get('theme');
		if($theme != '0') {
			$this->view = response()->view('theme/'.$theme.'/'.$viewLocation, $viewData);
			if(isset($cookieData)) {
				$this->addCookieData($cookieData);
				return $this->view;
			}
			return view('theme/'.$theme.'/'.$viewLocation, $viewData);
		}
		// if default theme is set or theme file is not implemented, fall back to original.
		return view($viewLocation, $viewData);
	}
	
	private function addCookieData($cookies) {
		if(is_array($cookies) && count($cookies) > 0) {
			foreach($cookies as $c) {
				$this->view = $this->view->withCookie($c);
			}
		}
		return $this->view;
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