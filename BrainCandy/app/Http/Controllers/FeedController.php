<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Interest;
use Auth;

class FeedController extends Controller
{
    public function index(){

    	$user = Auth()->user();
    	// dd($user->interestsString());

    	$user_interests = ($user->interests);

    	$interests_videos = [];

    	foreach($user_interests as $interest){

    		// This is an example JSON request for the purpose of testing to save Queries

    		$path = storage_path() . "/app/public/whales_youtube.json";


    		$response = json_decode(file_get_contents($path), false); 

    		$youtube_myInterests_results = $response;

    		// We will enable this json request for demo 
    		// ****************


			// $request = Request::create('/youtube/whywontitwork/'.$interest->interest, "GET");

			// $response = Route::dispatch($request);
			// $youtube_myInterests_results = json_decode($response->content(), true);



			// *******************

			// return $response;

			if($youtube_myInterests_results == null){
				// youtube didnt return anything, likely hit quota for the day
				abort(500); // server error
			}

			foreach($youtube_myInterests_results as $interest_result){

				// randomly choose some videos
				if(rand(0, 10) < 2){
					array_push($interests_videos, $interest_result);
				}
			}
		}

		if(count($interests_videos) == 0){
			array_push($interests_videos, $interest_result);
		}

		// foreach($interests_videos as $video){
		// 	info($video); //write info to console.log
		// }

		$youtube_interests = $interests_videos;

		// return view('feed.show', [
		// 	'youtube_interests' => compact($youtube_interests),
		// ]);
		// dd($youtube_interests);
		// foreach($youtube_interests as $temp){
		// 	dd($temp);
		// }
        return view('feed.show')->with('youtube_interests', $youtube_interests);
    	// Things to do in Index:
    	// TODO: Grab youtube api data based on 'tastes'
    	// TODO: Do the same for flickr and Twitter

    	// for example for youtube:
    	// $user = Auth()->user();
    	// // dd($user);
    	// $interests = $user->interests;
    	// $interests_array = [];
    	// // dd($interests);
    	// foreach ($interests as $item) {
    	// 	array_push($interests_array, $item->interest);
    	// }

    	//$request = Route::create('/youtube/search/', 'GET');

    	//$response = Route::dispatch($request);
    }
}
