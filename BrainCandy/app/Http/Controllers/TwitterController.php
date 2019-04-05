<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwitterController extends Controller
{
      public function index(){
        // dd("here");
        return view('twitter.index');
      }
}
