<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    
    public function show() {
    	\Admin::hasRoute('Admin info');
    	return \Theme::display('home.index', ['user' => \Auth::user(), 'links' => \Admin::routes()]);
    }
    
    public function adminInfo() {
    	return \Theme::display('admin.info', array());
    }
    
    public function saveAdminInfo(Request $request) {
    	$input = $request->input();
    	if(isset($input['name'])) {
    		\Configuration::set('app_name', $input['name']);
    	}
    	if(isset($input['debug'])) {
    		\Configuration::set('debug', $input['debug']);
    	}
    	else {
    		\Configuration::set('debug', 0);
    	}
    	return \Redirect::back();
    }
    
    public function showThemes() {
    	return \Theme::display('admin.themes', ['themes' => \Theme::lists(), 'selected' => \Configuration::get('theme')]);
    }
    
    public function saveThemes(Request $request) {
    	$theme = $request->input('theme');
    	\Configuration::set('theme', $theme);
    	return \Redirect::back();
    }
    
    public function frontEndCSS() {
    	// get the css
    	$fileData = \Theme::getCSS();
    	return \Theme::display('admin.css', ['file' => $fileData]);
    }
    
    public function saveFrontEndCSS(Request $request) {
    	$contents = $request->input('css');
    	$file = public_path().'/front.css';
    	$bytes_written = \File::put($file, $contents);
    	if ($bytes_written === false)
    	{
    		die("Error writing to file");
    	}
    	return \Redirect::back();
    }
    
    public function flushRoutes() {
    	\Configuration::delete('admin_routes');
    	return \Redirect::to('admin');
    }
}