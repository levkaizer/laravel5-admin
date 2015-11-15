<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \App\User;

class UserController extends Controller
{
    /**
     * Responds to requests to GET /users
     */
    public function getIndex()
    {
        //
        $users = User::all();
        return \Theme::display('users.index', array('users' => $users, 'show_modal_footer' => true));
    }

    /**
     * Responds to requests to GET /users/show/1
     */
    public function getShow($id)
    {
        //
    }
    
    public function postDelete(Request $request, $id)
    {
    	$user = User::find($id);
    	$user->delete();
    	return response()->json(['ok' => true, 'id' => $id]);
    }
    
    public function getEdit($id) {
    	$user = User::find($id);
        return \Theme::display('users.edit', array('user' => $user));
    }
    
    public function postEdit(Request $request, $id) {
    	$user = User::find($id);
    	
    	$user->fill( $request->except(['password', 'password_confirmation']) );
    	
    	if($request->has('password')) {
    		// now check that the passwords match...
    		if($request->input('password') == $request->input('password_confirmation')) {
    			$user->password = bcrypt($request->input('password'));
    		}
    		else {
    			return \Redirect::back()->withErrors(['password' => 'Passwords do not match.']);
    		}
    	}
    	$user->save();
    	
        return \Redirect::to('/admin/users');
    }
    
    public function postUpdate_password(Request $request) {
    	$password = bcrypt($request->input('password'));
    	$user = User::find($request->input('id'));
    	if(isset($user)) {
    		$user->password = $password;
    		$user->save();
    	}
    	
    }

}