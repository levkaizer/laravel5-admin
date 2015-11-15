<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    
    public function show() {
    	$stylesData = \Theme::GetCSS();
    	$styles = null;
    	if(file_exists($stylesData['path'])) {
    		$styles = $stylesData['path'];
    	}
    	$styles = explode('/', $styles);
    	$styles = array_pop($styles);
    	return \Theme::display('home.front', ['user' => \Auth::user(), 'styles' => $styles]);
    }
    
}