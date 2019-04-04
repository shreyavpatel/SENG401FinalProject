@extends('layouts.app')

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

		$( "li" ).hover( function() {
			$(this).css("background-color", "#CBCBCB");
			}, 
			function(){
  				$(this).css("background-color", "#fff");
		});

	});

</script>

<div class="container" style="width:65%">

	<div class="row">
       <div class="col-lg-12">

			<div class="btn-group" style="float: right">
			  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
			    Filter Feed
			  </button>
			  <ul class="dropdown-menu" style="text-align: left">
			  	<li data-value="videoopt" style="display:inline-block;padding-left: 15px;padding-right: 29.5px"><input type="checkbox" data-value="option1"/>&nbsp;Youtube Videos</li>
			  	<li data-value="photoopt" style="display:inline-block;padding-left: 15px;padding-right: 47.5px"><input type="checkbox"/>&nbsp;Flickr photos</li>
			  	<li data-value="tweetopt" style="display:inline-block;padding-left: 15px;padding-right: 81.5px"><input type="checkbox"/>&nbsp;Tweets</li>

			  </ul>
			</div>

		</div>
	</div>


</div>

@stop