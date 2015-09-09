<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    
    public function show() {
    	return \Theme::display('home.index', ['user' => \Auth::user(), 'links' => \Admin::routes()]);
    }
    
    public function adminInfo() {
    	return \Theme::display('admin.info', array());
    }
    
    public function showThemes() {
    	return \Theme::display('admin.themes', ['themes' => \Theme::lists()]);
    }
    
    public function SaveThemes() {
    }
}