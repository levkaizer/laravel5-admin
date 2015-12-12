<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \App\User;
use \App\Content;
use \App\UrlAlias;

class ContentController extends Controller
{   
    public function getAdd() {
    	$scripts = [url().'/trumbowyg/trumbowyg.min.js',
			url().'/trumbowyg/plugins/upload/trumbowyg.upload.js',
		];
		$styles = [url().'/trumbowyg/ui/trumbowyg.min.css'];
    	return \Theme::display('content.add', ['scripts' => $scripts, 'styles' => $styles]);
    }
    
    public function postAdd(Request $request) {
    	$content = new Content();
    	$content->title = $request->input('title');
    	$content->body = $request->input('content');
    	$content->status = $request->input('status');
    	$content->user_id = \Auth::user()->id;
    	
    	$content->save();
    	
    	if($request->has('alias')) {
    	
			$alias = new  UrlAlias();
			$alias->path = $request->input('alias');
		
			$content->alias()->save($alias);
			$content->save();
    	}
    	
    	return \Redirect::to('admin');
    }
    
    public function getContent($id) {
    	$content = Content::find($id);
    	if(isset($content)) {
    		$c = strip_tags($content->body, '<p><br><h1><h2><h3><h4><h5><h6><span><i><em><strong><img><a><ul><li><del><dfn><cite><code><pre><ins><q><s><samp><small><sub><sup><u><var><dl><dt><dd><table><thead><body><th><tr><td><tfoot><colgroup><col><caption>');
    		return \Theme::display('content.content', ['title' => $content->title, 'body' => $c]);
    	}
    	abort(404);
    }
    
    public function show() {
    	$content = Content::orderBy('updated_at', 'desc')->get();
    	return \Theme::display('content.admin-list', ['content' => $content]);
    }
    
    public function getEdit($id) {
    	$content = Content::find($id);
    	if(isset($content)) {
    		// now get the editor scripts
    		$scripts = [url().'/trumbowyg/trumbowyg.min.js',
    			url().'/trumbowyg/plugins/upload/trumbowyg.upload.js',
    			url().'/trumbowyg/plugins/colors/trumbowyg.colors.js',
    		];
    		$styles = [url().'/trumbowyg/ui/trumbowyg.min.css',
    		url().'/trumbowyg/plugins/colors/ui/trumbowyg.colors.css'];
    		return \Theme::display('content.admin-edit', ['content' => $content, 'scripts' => $scripts, 'styles' => $styles]);
    	}
    }
    
    public function postEdit(Request $request, $id) {
    	
    	$content = Content::find($id);
    	$content->title = $request->input('title');
    	$content->body = $request->input('content');
    	$content->status = $request->input('status');
    	
    	// add alias
    	$alias = $content->alias()->first();
    	if($request->has('alias')) {
    	
			if(!isset($alias)) {
				$alias = new  UrlAlias();
			}
			$alias->path = $request->input('alias');
		
			$content->alias()->save($alias);
    	}
    	else {
    		// remove the old if we had one...
    		if(isset($alias)) {
				$content->alias()->delete();
			}
    	}
    	
    	$content->save();
    	
    	return \Redirect::to('admin/content');
    }
    
    public function postUpload(Request $request) {
    	$fileName = time().'.jpg';
    	\Storage::put(
            'uploads/'.$fileName,
            file_get_contents($request->file('fileToUpload')->getRealPath())
        );
    	return response()->json(['message' => 'uploadSuccess', 'file' => '/uploads/'.$fileName]);
    }

}