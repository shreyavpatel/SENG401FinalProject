<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Interest;
use Auth;

class FeedController extends Controller
{
    public function index(){
    	// Things to do in Index:
    	// TODO: Grab youtube api data based on 'tastes'
    	// TODO: Do the same for flickr and Twitter

    	// for example for youtube:
    	$user = Auth::user();
    	// dd($user);
    	$interests = $user->interests;
    	$interests_array = [];
    	// dd($interests);
    	foreach ($interests as $item) {
    		array_push($interests_array, $item->interest);
    	}

    	$request = Route::create('/youtube/search/', 'GET');

    	$response = Route::dispatch($request);
    }
}
