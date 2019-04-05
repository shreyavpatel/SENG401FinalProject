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
// =======
// 			$request = Request::create('/youtube/whywontitwork/'.$interest, "GET"); // TODO what is this link supposed to be
// >>>>>>> 307d043c5a491b8117f03e8b2fc74e697746aba8

			$response = Route::dispatch($request);

			$youtube_myInterests_results = json_decode($response->content());
			if($youtube_myInterests_results == null){
				// youtube didnt return anything, likely hit quota for the day
				abort(500); // server error
			}

			foreach($youtube_myInterests_results as $interest_result){

				// randomly choose some videos
				if(rand(0, 10) < 3){
					array_push($interests_videos, $interest_result);
				}
			}
		}

		// foreach($interests_videos as $video){
		// 	info($video); //write info to console.log
		// }

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
