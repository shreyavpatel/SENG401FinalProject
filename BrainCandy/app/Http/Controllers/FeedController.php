<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Interest;
use Auth;

class FeedController extends Controller
{
    public function index(){

    	$user = Auth::user();
    	// dd($user->interestsString());

    	$user_interests = ($user->interests);

    	$interests_videos = [];

    	foreach($user_interests as $interest){

			$request = Request::create('/youtube/whywontitwork/'.$interest->interest, "GET");

			$response = Route::dispatch($request);

			
			$youtube_myInterests_results = ($response);
			
			dd($youtube_myInterests_results);
			foreach($youtube_myInterests_results as $interest_result){

				// randomly choose some videos
				dd($interest_result);
				if(rand(0, 10) < 3){
					array_push($interests_videos, $interest_result);
				}
			}
		}

		foreach($interests_videos as $video){
			info($video);
		}
		dd($interests_videos);
        return view('feed.show')->with('youtube_interests', $interests_videos);
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

    	//$request = Route::create('/youtube/search/', 'GET');

    	//$response = Route::dispatch($request);
    }
}
