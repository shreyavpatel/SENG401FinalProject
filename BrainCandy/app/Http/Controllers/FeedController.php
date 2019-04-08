<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Interest;
use Auth;

class FeedController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

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
      // shuffle($tweets); // everything is shuffled later anyways when mixed together
      return $tweets;
    }

    public function getFlickrs($interests){
      $count =(int) floor(25/sizeof($interests));
      $flickrs = array();
      foreach($interests as $interest){
        $request = 'https://api.flickr.com/services/rest/?api_key=9ba520fd0687a94ce0684343f3def081&method=flickr.photos.search&format=json&nojsoncallback=1&per_page=15&tags='.$interest['interest'];
        $rsp = file_get_contents($request);
        $rsp = str_replace('jsonFlickrApi(', '', $rsp );
        $rsp = substr( $rsp, 0, strlen( $rsp ) );
        $flickrs = json_decode($rsp, true);
        $flickrs = $flickrs['photos']['photo'];
      }
    //  dd ($flickrs);
      // shuffle($flickrs); // everything is shuffled later anyways when mixed together
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
          console.log('$youtube_myInterests_results is null in FeedController:youtube didnt return anything, likely hit quota for the day ');
          // abort(500); // server error
          $youtube_myInterests_results = [];
        }

        foreach($youtube_myInterests_results as $interest_result){
          // randomly choose some videos
          if(rand(0, 10) < 2){
            array_push($interests_videos, $interest_result);
          }
        }
		  }

      if(count($interests_videos) == 0){ //TODO what does this do?
        array_push($interests_videos, $interest_result); // the variable interest_result is out of scope here?
      }

      $youtube_interests = $interests_videos;
      // dd($youtube_interests);
      // END OF YOUTUBE API STUFF *****************************************


      // START OF TWITTER API STUFF ***************************************
      $tweets = FeedController::getTweets($user_interests);
      //dd($tweets);
      // END OF TWITTER API STUFF *****************************************


      // START OF FLICKR API STUFF ***************************************
      $flickrs = FeedController::getFlickrs($user_interests);
      //  dd($flickrs[0]['id']);
      // END OF FLICKR API STUFF ***************************************


      //COMBINE, RANDMOZE THE FEED ***************************************
      //need to give them each some flag to tell feed if is a tweet, youtube, or twitter
      $videos = [];
      foreach($youtube_interests as $vid){
        array_push($videos,['src'=>$vid, 'platform'=>0]);
      }
      $flickr_photos = [];
      foreach($flickrs as $f){
        array_push($flickr_photos,['src'=>$f, 'platform'=>1]);
      }
      $twitter_tweets = [];
      foreach($tweets as $t){
        array_push($twitter_tweets,['src'=>$t, 'platform'=>2]);
      }
      //merge the feed items
      $feedItems = array_merge($videos, $twitter_tweets);
      $feedItems = array_merge($feedItems, $flickr_photos);
      //randomize the order
      shuffle($feedItems);

      return view('feed.show')->with('feedItems', $feedItems);

      // return view('feed.show')->with('youtube_interests', $youtube_interests)
      //                         ->with('tweets', $tweets)
      //                         ->with('flickrs', $flickrs);
    }

}
