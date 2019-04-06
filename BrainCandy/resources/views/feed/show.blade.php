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
		var options = [];
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

			console.log( options );
			return false;
		});

		$( ".myHover" ).hover( function() {
			$(this).css("background-color", "#6DD1B0");
			},
			function(){
  				$(this).css("background-color", "#fff");
		});

		if(document.getElementById('youtube').checked) {
			$(document.getElementById('Youtube Results')).show();

		}
		else {
			$(document.getElementById('Youtube Results')).hide();
		}

		if(document.getElementById('flickr').checked) {
			$(document.getElementById('Flickr Results')).show();

		}
		else {
			$(document.getElementById('Flickr Results')).hide();
		}

		if(document.getElementById('twitter').checked) {
			$(document.getElementById('Twitter Results')).show();

		}
		else {
			$(document.getElementById('Twitter Results')).hide();
		}



	});

</script>

<div class="container" style="width:65%">


<div class='row'>
        <div class="col-md-2" >
            <img class="link_logo" src="{{ asset('mouth.png') }}">
        </div>
				<div class="col-md-8" style='text-align:center'>
						<br>
            <h1>My Feed</h1>
        </div>
        <div class="col-md-2" >
            <img class="link_logo" src="{{ asset('mouth.png') }}">
        </div>
		</div>

	<hr>

	<div class="row">
       <div class="col-lg-12">

			<div class="btn-group" style="float: right">
			  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style='background-color:#6DD1B0'>
			    My Palette
			  </button>
				<ul class="dropdown-menu" style="text-align: left">
					<div class='myHover'>
				  		<li data-value="videoopt" style="display:inline-block;padding-left: 15px;"><input id = "youtube" type="checkbox" checked/>&nbsp;Youtube Videos</li>
						</div>
					<div class='myHover'>
						<li data-value="photoopt" style="display:inline-block;padding-left: 15px;"><input id = "flickr" type="checkbox"checked/>&nbsp;Flickr photos</li>
					</div>
					<div class='myHover'>
						<li data-value="tweetopt" style="display:inline-block;padding-left: 15px;"><input id = "twitter" type="checkbox"checked/>&nbsp;Tweets</li>
					</div>

			  </ul>
			</div>

		</div>
	</div>



	<div id="feed">
		@foreach ($feedItems as $item)
			<hr>
			@if($item['platform']==0) <!-- YOUTUBE -->
					<!-- <a href=" $item['src']->url "> -->
						<h5>{{ $item['src']->snippet->title }}</h5>
						<iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $item['src']->id->videoId}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<!-- <img src=" $item['src']->snippet->thumbnails->medium->url "> -->

			@elseif($item['platform']==1) 	<!-- FLICKR -->
					<div class="flickr_container" >
						<a href="https://www.flickr.com/photos/{{$item['src']['owner']}}/{{$item['src']['id']}}">
						<h5>{{$item['src']['title']}}</h5>
							<img src= "https://farm{{$item['src']['farm']}}.staticflickr.com/{{$item['src']['server']}}/{{$item['src']['id']}}_{{$item['src']['secret']}}.jpg">
						</a>
					</div>

			@elseif($item['platform']==2) <!-- TWITTER -->
				<div class="tweet_container" id="{{$item['src']}}"></div>

			@endif
			<!-- like button -->
			<!-- Form::model($item, ['method'=>'POST', 'action'=>['LikeController@store',$item]])  -->
			<!-- {!!Form::open(array('action' => 'LikeController@store' )) !!}
				{!! Form::hidden('$item', json_encode($item)) !!}
				{!! Form::submit('Like', ['class' => 'btn btn-outline-danger btn-sm']) !!}
			{!! Form::close() !!} -->

			<a method="POST" href=" {{ action('LikeController@store', ['item' => $item]) }}" class="btn">Like</a>

			<!-- TODO: give a popup that it liked successfuly, or turn it into an unlike button -->
		@endforeach
	</div>


</div><!-- end of div class='row' -->



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
