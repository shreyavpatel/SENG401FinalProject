@extends('layouts.app')

@section('content')

<div class="container" style="width: 55%">


<div class='row'>
        <div class="col-md-3" >
            <img class="link_logo" src="jawbreaker.png"> 
        </div>
        <div class="col-md-7" style='text-align:center'>
            <br>
            <h1>My Jaw Droppers</h1>
        </div>     
        <div class="col-md-2" >
            <img class="link_logo" src="jawbreaker.png">
        </div> 
</div>
<hr>

@foreach($likes as $like)
<div class="row">

    @if($like->platform == 0) <!-- YOUTUBE -->
            <!-- bootstrap class="row" divides the page in 12 columns. we decide how wide each of the following elements should be with class="col-md-X"-->
            <div class="col-md-3">
                <a href='youtube/show/{{$like->item}}'>
                    <!-- THUMBNAIL -->
                    <img src="https://img.youtube.com/vi/{{$like->item}}/0.jpg" alt="YT img" class="img-fluid">
            </div>
                <div class="col-md-8">
                    <h2>
                        {{$like->getYoutubeTitle()}}
                        <!-- <iframe width="280" height="158" src="https://www.youtube.com/embed/{{$like->item}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                    </h2>
                </a>
            </div>
    @elseif($like->platform == 1) <!-- FLICKR -->
        flickr
    @elseif($like->platform == 2) <!-- TWITTER -->
        tweet
    @else
        error: platform is {{$like->platform}}
    @endif

        <div class="col-md-1">
            <div class="btn-group-vertical" style="position:absolute;right:30%;bottom:0">
                <!--  REMOVE BUTTON   -->
                {!! Form::model($like, ['method'=>'DELETE', 'action'=>['LikeController@destroy',$like->id]]) !!}
                {!! Form::submit('Remove', ['class' => 'btn btn-outline-danger btn-sm']) !!}
                {!! Form::close() !!}
            </div style="font-size:15px">
        </div>  
    </div> <!--end row -->
    <hr>
@endforeach


</div>   

@include ('errors.list')

@stop
