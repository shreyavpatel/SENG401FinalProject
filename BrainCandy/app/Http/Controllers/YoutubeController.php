<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

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
}
