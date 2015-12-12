<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;

use \App\MailList;
use \App\ListMember;

class MailListController extends Controller
{
    use ValidatesRequests;
    public function getAdminLists() {
    	$lists = MailList::all();

    	return \Theme::display('lists.admin-list', ['lists' => $lists]); 
    }
    
    public function getAdminCreateList() {
    	return \Theme::display('lists.admin-list-add', array()); 
    }
    
    public function postAdminCreateList(Request $request) {
    	$this->validate($request, [
        	'list_name' => 'required|unique:mail_lists|max:250',
    	]);
    	
    	// ok?
    	$list = new MailList();
    	$list->list_name = $request->input('list_name');
    	$list->active = 1;
    	$list->save();
    	
    	return \Redirect::to('admin/lists')->withMessage('List added.');
    }
    
    public function getAdminEditList($id) {
    	$list = MailLIst::find($id);
    	return \Theme::display('lists.admin-list-edit', ['list' => $list]); 
    }
    
    public function postAdminEditList(Request $request, $id) {
    	$list = MailList::find($id);
    	
    	// check they're not the same...    	
    	if($request->input('list_name') != $list->list_name) {
    		$this->validate($request, [
        		'list_name' => 'required|unique:mail_lists|max:250',
    		]);
    	}
    	
    	if(strlen($request->input('list_name'))) {
    		$list->list_name = $request->input('list_name');
    	}
    	
    	if($request->has('active')) {
    		$list->active = 1;
    	}
    	else {
    		$list->active = 0;
    	}
    	$list->save();
    	
    	return \Redirect::to('admin/lists');
    	
    }
    
    public function postStatus(Request $request, $id)
    {
    	$list = MailList::find($id);
    	$list->active = ($list->active) ? 0 : 1;
    	$list->save();
    	return response()->json(['ok' => true, 'id' => $id, 'status' => $list->active]);
    }
    
    public function postDelete(Request $request, $id)
    {
    	$list = MailList::find($id);
    	$list->delete();
    	return response()->json(['ok' => true, 'id' => $id]);
    }
    
    public function getMembers($listId) {
    	$list = MailList::find($listId);
    	$members = ListMember::where('list_id', $listId)->orderBy('updated_at', 'desc')->get();
    	return \Theme::display('lists.admin-list-members', ['members' => $members, 'list' => $list]); 
    }
    
    public function getHomepageList() {
    	$lists = MailList::where('active', '1')->lists('list_name', 'id');
    	return \Theme::display('lists.admin-list-homepage', ['lists' => $lists]); 
    }
    
    public function postHomepageList(Request $request) {
    	\Configuration::set('default_list', $request->input('homepage_list'));
    	return \Redirect::to('admin');
    }
    
    public function form() {
    }
    
    public function submit(Request $request) {
    	$list = MailList::find($request->list);
    	
    	$this->validate($request, [
    		'list' => 'required|exists:mail_lists,id',
        	'first_name' => 'required|max:250',
        	'last_name' => 'required|max:250',
        	'email' => 'required|unique:list_members|email|max:250',
    	]);
    	
    	$member = new ListMember();
    	$member->list_id = $request->list;
    	$member->first_name = $request->first_name;
    	$member->last_name = $request->last_name;
    	$member->email = $request->email;
    	$member->subscribed = 1;
    	$member->save();
    	return \Redirect::to('/')->withMessage('Thank you for subscribing!')
    		->withCookie(cookie()->forever('list_joined', $request->list))
    		->withCookie(cookie()->forever('list_cid', $member->id));
    }
    
    public function unsubscribe(Request $request) {
    	$cookie_list = $request->cookie('list_joined');
    	$cid = $request->cookie('list_cid');
    	if($cookie_list && $cid) {
    		// now we can unsubscribe the user
    		$member = ListMember::find($cid);
    		$member->subscribed = 0;
    		$member->save();
    		
    		$list = MailList::find($cookie_list);
    		
    		$c1 = \Cookie::forget('list_joined');
    		$c2 = \Cookie::forget('list_cid');
    		
    		return \Theme::display('lists.list-remove', ['list' => $list], array($c1, $c2));  
    	}
    	
    	// look for get varibale
    	if($request->has('e')) {
    		$member = ListMember::where('email', $request->e)->first();
    		$member->subscribed = 0;
    		$member->save();
    		
    		$list = MailList::find($member->list_id);
    		
    		// for good measure, unset cookie too.
    		$c1 = \Cookie::forget('list_joined');
    		$c2 = \Cookie::forget('list_cid');
    		
    		return \Theme::display('lists.list-remove', ['list' => $list], array($c1, $c2));  
    	}
    	
    	// dfault page
    	// @todo set up a way of searching email addresses and unsubsribing them.
    	return \Theme::display('lists.list-subscriptions', []);  
    }
    
}