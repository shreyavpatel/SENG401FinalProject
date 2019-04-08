@extends('layouts.app')

<!-- Twitter Rendering -->
<script>
    window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function(f) {
        t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));
</script>

@section('content')

<script>
	$(document).ready(function(){
		var options = ['videoopt', 'photoopt', 'tweetopt'];
		$( '.dropdown-menu li' ).on( 'click', function(event) {
	   		var $target = $( event.currentTarget ),
		       val = $target.attr( 'data-value' ),
		       $inp = $target.find( 'input' ),
		       idx;

	   		if ( ( idx = options.indexOf( val ) ) > -1 ) {
		      options.splice( idx, 1 );
		      setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
	   		} else {
		      options.push( val );
		      setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
	   		}

		   $( event.target ).blur();

		   if(options.length <= 3) { //Ross made this <=, lets youtube videos be able to be shown again after hiding 
				if(jQuery.inArray("videoopt", options) !== -1) {
					$('.youtube_container').show();
				}
				else {
					$('.youtube_container').hide();

				}
				if(jQuery.inArray("photoopt", options) !== -1) {
					$('.flickr_container').show();
				}
				else {
					$('.flickr_container').hide();
				}
				if(jQuery.inArray("tweetopt", options) !== -1) {
					$('.tweet_container').show();
				}
				else {
					$('.tweet_container').hide();
				}
			}

			console.log( options );
			return false;
		});

		$( ".myHover" ).hover( function() {
			$(this).css("background-color", "#6DD1B0");
			},
			function(){
  				$(this).css("background-color", "#fff");
		});

	});

</script>
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

<div class="row">
    <div class="col-lg-12">
        <div class="btn-group" style="float: right">
            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" style='background-color:#6DD1B0;color:white;'>
            My Palette
            </button>
            <ul class="dropdown-menu" style="text-align: left">
                <div class='myHover'>
                    <li data-value="videoopt" style="display:inline-block;padding-left: 15px;"><input name = "youtube" type="checkbox" checked/>&nbsp;Youtube Videos</li>
                    </div>
                <div class='myHover'>
                    <li data-value="photoopt" style="display:inline-block;padding-left: 15px;"><input name = "flickr" type="checkbox"checked/>&nbsp;Flickr Photos</li>
                </div>
                <div class='myHover'>
                    <li data-value="tweetopt" style="display:inline-block;padding-left: 15px;"><input name = "twitter" type="checkbox"checked/>&nbsp;Tweets</li>
                </div>
            </ul>
        </div>
    </div>
</div>

@foreach($likes as $like)
<div class="row" style='position:relative;'>
    <div class="col-md-11"> 

  
    @if($like->platform == 0) <!-- YOUTUBE -->
        <div class="youtube_container">	
            <a href='youtube/show/{{$like->item}}'>
                <!-- THUMBNAIL --><!-- <img src="https://img.youtube.com/vi/{{$like->item}}/0.jpg" alt="YT img" class="img-fluid"> -->
                <h2>{{$like->getYoutubeTitle()}}</h2>
                <iframe width="400" height="226" src="https://www.youtube.com/embed/{{$like->item}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </a>
            <div class="btn-group-vertical" style="font-size:15px;position:absolute;bottom:5%;right:0;">
                <!--  REMOVE BUTTON   -->
                {!! Form::model($like, ['method'=>'DELETE', 'action'=>['LikeController@destroy',$like->id]]) !!}
                {!! Form::submit('Remove', ['class' => 'btn btn-outline-danger btn-sm']) !!}
                {!! Form::close() !!}
            </div>
            <hr>
        </div>
    @elseif($like->platform == 1) <!-- FLICKR -->
        <div class="flickr_container" >        
            <a href="{{explode (' ', $like->item)[0] }}">
            <h5>{{explode (' ', $like->item)[1] }}</h5> 
                <img src="{{explode (' ', $like->item)[2] }}" max-height='250px'> 
                <!-- todo update the size to be fixed? -->
            </a>
            <div class="btn-group-vertical" style="font-size:15px;position:absolute;bottom:5%;right:0;">
                <!--  REMOVE BUTTON   -->
                {!! Form::model($like, ['method'=>'DELETE', 'action'=>['LikeController@destroy',$like->id]]) !!}
                {!! Form::submit('Remove', ['class' => 'btn btn-outline-danger btn-sm']) !!}
                {!! Form::close() !!}
            </div>
            <hr>
        </div>

    @elseif($like->platform == 2) <!-- TWITTER -->
        <div class="tweet_container" id="{{$like->item}}">
            <!-- the tweet will be rendered here --> 
        </div>
        <div class="btn-group-vertical tweet_container" style="font-size:15px;position:absolute;bottom:5%;right:0;">
                    <!--  REMOVE BUTTON   -->
                    {!! Form::model($like, ['method'=>'DELETE', 'action'=>['LikeController@destroy',$like->id]]) !!}
                    {!! Form::submit('Remove', ['class' => 'btn btn-outline-danger btn-sm']) !!}
                    {!! Form::close() !!}
            </div>
        <hr>

    @else
        <!-- error: platform is {{$like->platform}} -->
    @endif
    
    </div><!-- end col-md-11 -->

    

</div> <!--end row -->
@endforeach


</div>   <!--end container -->

@endsection

@section("footer_scripts")
<script>
    $(document).ready(function(){
        $('.tweet_container').each(function(){
                // for rendering tweets
                let me =$(this).get(0);
                let id = $(this).attr('id');
                //console.log(id, me);
                setTimeout(function(){
                    twttr.widgets.createTweet(
                        id,
                        me,
                    {
                        theme: 'light'
                    }
                    ).then( function( el ) {
                        console.log("tweet added");
                    });
                    twttr.widgets.load(
                        me
                    );
                },2000);
        });
    });
</script>
@endsection
