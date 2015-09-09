<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProfileController extends Controller
{
    /**
     * Update the user's profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateProfile(Request $request)
    {
        if ($request->user()) {
            // $request->user() returns an instance of the authenticated user...
            $validator = \Validator::make($request->all(), [
				'name' => 'required|max:255',
				'email' => 'required|unique:users,email,'.$request->user()->id,
				'password' => 'min:5|same:password_confirmation',
			]);
			
			
			if ($validator->fails()) {
				return redirect('profile/edit')
							->withErrors($validator)
							->withInput();
			}
			else {
				$request->user()->fill($request->except('password', 'password_confirmation'));
				if(strlen($request->input('password')) > 0) {
					$request->user()->password = \Hash::make($request->input('password'));
				}
				$request->user()->save();
				return \Redirect::to('/profile');
			}
        }
    }
    
    public function show() {
    	return view('profile.index', ['user' => \Auth::user()]);
    }
    
    public function getEdit() {
    	return view('profile.edit', ['user' => \Auth::user()]);
    }
    
}