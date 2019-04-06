<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

class FlickrController extends Controller
{
  public function index(){

    return view('flickr.index');

    // $url = "https://api.flickr.com/services/rest/?api_key=5a9ff9afbf3deba6741621c4f543dee5&method=flickr.photos.search&format=json&nojsoncallback=1";

    // // Create GET request to use api
    //   $request = Request::create($url, 'GET');

    //   // dispatch request to API
    //   $response = Route::dispatch($request);

    //   dd($response); //TODO remove

    //   //decode the response json into arrays (true argument)
    //   $data = json_decode($response->content(), true);
    //   dd($data); //TODO remove

    // return "nothing";
  }

  public function show($url){
    // $full_url = "https://www.flickr.com/embed/".$url;
    // // dd($full_url);
    // return view('youtube.show')->with('url', $full_url);
  }
}
