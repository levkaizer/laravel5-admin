<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use \App\MailList;
use \App\ListMember;

class HomeController extends Controller
{
    
    public function show(Request $request) {
    	$stylesData = \Theme::GetCSS();
    	$styles = null;
    	if(file_exists($stylesData['path'])) {
    		$styles = $stylesData['path'];
    	}
    	$styles = explode('/', $styles);
    	$styles = array_pop($styles);
    	
    	// now check for cookies
    	$cookie_list = $request->cookie('list_joined');
    	$showList = false;
    	$showThankyou = false;
    	// check if there is a default list
    	if(\Configuration::get('default_list')) {
    		$showList = true;
    	}
    	
    	if(isset($cookie_list) && $cookie_list == \Configuration::get('default_list') ) {
    		$showList = false;
    		if($request->cookie('list_cid')) {
		    	// check if the user is on the current list...
    			$member = ListMember::find( $request->cookie('list_cid') );    
    			if($member->list_id == \Configuration::get('default_list')) {
    				$showThankyou = true;
    			}		
    		}
    	}
    	
    	return \Theme::display('home.front', ['user' => \Auth::user(), 'styles' => $styles, 'showList' => $showList, 'thankyou' => $showThankyou]);
    }
    
}