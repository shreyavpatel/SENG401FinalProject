<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Interest;
use Auth;

class FeedController extends Controller
{

    public function getTweets($interests){
      $count =(int) floor(25/sizeof($interests));
      $tweets = array();
      foreach($interests as $interest){
        $request = Request::create(url('/api/twitter/id').'/'.$count.'/'.$interest['interest'], "GET");
        $response = Route::dispatch($request);
        //dd($response);
        $result_arr = json_decode($response->getContent());
        $tweets = array_merge($tweets, $result_arr);
      }
      shuffle($tweets);
      return $tweets;
    }

    public function getFlickrs($interests){
      $count =(int) floor(25/sizeof($interests));
      $flickrs = array();
      foreach($interests as $interest){
        $request = 'https://api.flickr.com/services/rest/?api_key=9ba520fd0687a94ce0684343f3def081&method=flickr.photos.search&format=json&nojsoncallback=1&tags='.$interest['interest'];
        $rsp = file_get_contents($request);
        $rsp = str_replace('jsonFlickrApi(', '', $rsp );
        $rsp = substr( $rsp, 0, strlen( $rsp ) );
      //  dd($rsp);
        $flickrs = json_decode($rsp, true);
        $flickrs = $flickrs['photos']['photo'];
      }
      shuffle($flickrs);
      return $flickrs;
    }


    public function index(){

    	$user = Auth()->user();
    	// dd($user->interestsString());

    	$user_interests = ($user->interests);

    	$interests_videos = [];

    	foreach($user_interests as $interest){

    		// Youtube API stuff *******************************************************

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

		$youtube_interests = $interests_videos;
    // dd($youtube_interests);

		// END OF YOUTUBE API STUFF *****************************************
    // START OF TWITTER API STUFF ***************************************
    $tweets = FeedController::getTweets($user_interests);
  //  dd($tweets);
    // END OF TWITTER API STUFF *****************************************




    // START OF FLICKR API STUFF ***************************************
    $flickrs = FeedController::getFlickrs($user_interests);
  //  dd($flickrs[0]['id']);
    // END OF FLICKR API STUFF ***************************************


    return view('feed.show')->with('youtube_interests', $youtube_interests)->with('tweets', $tweets)->with('flickrs', $flickrs);
    	// Things to do in Index:
    	// TODO: Grab youtube api data based on 'tastes'
    	// TODO: Do the same for flickr and Twitter

    }

}
