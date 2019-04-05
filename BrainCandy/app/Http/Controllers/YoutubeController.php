<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

class YoutubeController extends Controller
{


    public function index(){

    	return view('youtube.index');
    	// GET https://www.googleapis.com/youtube/v3/search

    	// Create GET request to use api
        $request = Request::create('https://www.googleapis.com/youtube/v3/search/?part=snippet&maxResults=25&q=surfing&key=AIzaSyDsbrC-_RBZ28drg6FNV01xjvJ_QkYHZvE', 'GET');

        // dispatch request to API
        $response = Route::dispatch($request);

        dd($response); //TODO remove

        //decode the response json into arrays (true argument)
        $data = json_decode($response->content(), true);
        dd($data); //TODO remove

    	return "nothing";
    }

    public function show($url){
    	$full_url = "https://www.youtube.com/embed/".$url.'?autoplay=1';
    	return view('youtube.show')->with('url', $full_url);
    }

    public function mySearch($interests){
    	$myURL = ("https://www.googleapis.com/youtube/v3/search/?part=snippet&maxResults=25&key=AIzaSyDsbrC-_RBZ28drg6FNV01xjvJ_QkYHZvE&q=".$interests);
    	
    	$client = new Client();
		$res = $client->get($myURL);
		// dd($res);
		// echo $res->getStatusCode(); // 200
		return (json_decode((String) $res->getBody())->items);
		  //   	$request2 = Request::create($myURL, 'GET');
    // 	dd($request2);
    // 	$response = Route::dispatch($request2);

    // 	return $interests;
    }
}
