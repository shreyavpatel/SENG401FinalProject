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
        $platform = $request->input('item')['platform']; // 0 youtube, 1 Flickr, 2 Twitter
        // dd($request->input('item')['src']);

        $itemVal = null;
        if($platform==0){//youtube
            $itemVal = $request->input('item')['src']['id']['videoId'];
        }
        if($platform==1){//flickr
            //right now, a flickr item is stored in the database in the following format: '<href> <title> <imgLink>'. I know this isnt good database design k
            $itemVal =  "https://www.flickr.com/photos/".$request->input('item')['src']['owner']."/".$request->input('item')['src']['id']. " " .$request->input('item')['src']['title']." https://farm".$request->input('item')['src']['farm'].".staticflickr.com/".$request->input('item')['src']['server']."/".$request->input('item')['src']['id']."_".$request->input('item')['src']['secret'].".jpg";
            // "https://www.flickr.com/photos/{{$item['src']['owner']}}/{{$item['src']['id']}}". title={{$item['src']['title']}}, and src="https://farm{{$item['src']['farm']}}.staticflickr.com/{{$item['src']['server']}}/{{$item['src']['id']}}_{{$item['src']['secret']}}.jpg"
        }
        if($platform==2){//twitter'
            $itemVal = $request->input('item')['src']; // just the tweet ID
        }
        
        Like::create([
            'user_id'=> Auth()->user()->id,
            'item'=>$itemVal,
            'platform'=> $platform
        ]);
        return Redirect::back();
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
