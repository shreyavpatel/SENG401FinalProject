@extends('layouts.app')

@section('content')

<script>
	$(document).ready(function() {
	$('.mdb-select').materialSelect();
	});
</script>

<div class="container" style="width:65%">

	<div class="col-md-2" style="float: right">

	  <select class="mdb-select colorful-select dropdown-success md-form">
	    <option value="" disabled selected>Filter Feed</option>
	    <option value="1">Youtube Videos</option>
	    <option value="2">Tweets</option>
	    <option value="3">Flickr Photos</option>
	  </select>
	  <!-- <button class="btn-save btn btn-primary btn-sm">Save</button> -->

	</div>
	
</div>	

<!-- <div style="width: 60px; float: right">	

 {{ Form::open(['method' => 'GET']) }}
   
                  <div class="form-group">
                    <lable for="country">Filter</lable>
                    <select name="country" id="country" class="form-control">
                      <option value="optvideos">&nbsp;&nbsp;&nbsp;Youtube Videos</option>
                    </select> 
                  </div>

 {{ Form::close() }}

</div> -->

<!-- <div class="btn-group" style="float: right">
  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Filter Feed
  </button>
  <div class="dropdown-menu multiselect">
    <a class="dropdown-item" href="#">
    	<div class="radio">
  			<label><input type="radio" name="optvideos">&nbsp;&nbsp;&nbsp;Youtube Videos</label>
		</div>
	</a>
    <a class="dropdown-item" href="#">
    	<div class="radio">
  			<label><input type="radio" name="opttweets">&nbsp;&nbsp;&nbsp;Tweets</label>
		</div>
	</a>
    <a class="dropdown-item" href="#">
    	<div class="radio">
  			<label><input type="radio" name="optphotos">&nbsp;&nbsp;&nbsp;Flickr Photos</label>
		</div>
	</a>
  </div>
</div> -->

</div>

@stop