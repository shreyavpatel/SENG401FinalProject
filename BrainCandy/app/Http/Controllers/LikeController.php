<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LikeController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $likes = Auth()->user()->likes;
        return view('users.likes')->with('likes',$likes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return "BEFORE";
        $var = $request->input('item');
        $request_decode =  json_decode($var, true);
        $platform = $request_decode['platform'];
        // $platform = $request->input('item')['platform']; // 0 youtube, 1 Flickr, 2 Twitter
        // return "here";
        // dd($request->input('item')['src']);
        $itemVal = null;
        if($platform==0){//youtube
            $itemVal= $request_decode['src']['id']['videoId'];
            // $itemVal = $request->input('item')['src']['id']['videoId'];
            // return "here";
        }


        if($platform==1){//flickr
            
            $itemVal =  "https://www.flickr.com/photos/".$request_decode['src']['owner']."/".$request_decode['src']['id']. " " .$request_decode['src']['title']." https://farm".$request_decode['src']['farm'].".staticflickr.com/".$request_decode['src']['server']."/".$request_decode['src']['id']."_".$request_decode['src']['secret'].".jpg";
        }
        if($platform==2){//twitter'
            $itemVal = $request_decode['src']; // just the tweet ID
        }
        
        Like::create([
            'user_id'=> Auth()->user()->id,
            'item'=>$itemVal,
            'platform'=> $platform
        ]);
        return "200 Query OKAY";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        $like->delete();
        return redirect('likes');
    }
}
