<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \App\User;

class InstallController extends Controller
{
    public function getIndex()
    {
        //
        if(!\Configuration::installed()) {
        	// load install views
        	return view('install.install');
        }
    }
    
    public function postIndex(Request $request) {
    	$nameVal = \Validator::make($request->all(), [
    		'name' => 'required',
    		'email' => 'required|unique:users|email|max:255',
    		'password' => 'required|min:6',
    		'admin_name' => 'required',
    		'password_confirm' => 'required_with:password|same:password|min:6'
    	]);
    	
    	if ($nameVal->fails()) {
            return redirect('install')
                        ->withErrors($nameVal)
                        ->withInput();
        }
        
        // save the user
        $user = new User();
        $user->email = $request->input('email');
        $user->name = $request->input('admin_name');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        
        \Configuration::set('app_name', $request->input('name'));
        \Configuration::set('installed', bcrypt(time()));
        
        if (\Auth::attempt(['email' => $user->email, 'password' => $request->input('password')])) {
            // Authentication passed...
            return redirect()->intended('admin');
        }
    }

}