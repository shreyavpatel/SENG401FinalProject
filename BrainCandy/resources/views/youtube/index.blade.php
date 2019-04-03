@extends('layouts.app')

@section('content')

<html>

<head>
	<title>Youtube API search</title>
</head>

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
	      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	      crossorigin="anonymous">
	</script>

<body>
	<div>
		Enter search item: <br>
		<input type="text" id="searchParameter">
		<input type="submit" id="search" value="Search">
	</div>

	<div id="testResultArea">


	</div>
</body>

</html>



<script>
         $(document).ready(function(){
         	$("#search").click(function(){
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                  }
              });
               console.log("https://www.googleapis.com/youtube/v3/search/?part=snippet&maxResults=25&key=AIzaSyDsbrC-_RBZ28drg6FNV01xjvJ_QkYHZvE&q=" + $("#searchParameter").val());
               $.ajax({
                  url: "https://www.googleapis.com/youtube/v3/search/?part=snippet&maxResults=25&key=AIzaSyDsbrC-_RBZ28drg6FNV01xjvJ_QkYHZvE&q=" + $("#searchParameter").val(),
                  method: 'GET',
                  data: {
               
                  },
                  success: function(result){

                  	// console.log(result['items']['snippet']);
                  		$("#testResultArea").html('');
					    $.each(result['items'], function (index, value) {
					    	console.log(value);
					        $("#testResultArea").append (
							 "  <img src="+ value['snippet']['thumbnails']['default']['url']+" class='img-fluid'>" + 
							 "<h3> " + value['snippet']['title'] + "</h3>" + 
							 "<h5> Channel: " + value['snippet']['channelTitle'] + "</h5>" +
							"<hr>");
					});
                  }});
           });
            });
</script>

@endsection