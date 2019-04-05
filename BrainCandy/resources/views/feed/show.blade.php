@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
          integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
          crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

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
			  		<li data-value="videoopt" style="display:inline-block;padding-left: 15px;"><input type="checkbox" data-value="option1"/>&nbsp;Youtube Videos</li>
					</div>
					<div class='myHover'>
						<li data-value="photoopt" style="display:inline-block;padding-left: 15px;"><input type="checkbox"/>&nbsp;Flickr photos</li>
					</div>
					<div class='myHover'>
						<li data-value="tweetopt" style="display:inline-block;padding-left: 15px;"><input type="checkbox"/>&nbsp;Tweets</li>
					</div>

			  </ul>
			</div>

		</div>
	</div>

	<div id="Youtube results">


		<h4> Your youtube FLAVOURS </h4>
		@foreach ($youtube_interests as $interest)
		
			<hr>
			
			<!-- <a href=" $interest->url "> -->
				<iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $interest->id->videoId}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			<!-- <img src="{{ $interest->snippet->thumbnails->medium->url }}"> -->

			<h5>{{ $interest->snippet->title }}</h5>

			<a>

		@endforeach
	</div>

</div>
@stop