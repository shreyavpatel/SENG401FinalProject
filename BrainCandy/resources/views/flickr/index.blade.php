@extends('layouts.app')

@section('content')

<html>

<head>
	<title>Flickr API search</title>
</head>


<body>
	<div>
		Enter search item: <br>
		<input type="text" id="searchParameter">
		<input type="submit" id="search" value="Search">
	</div>

		<div id="testResultArea" class="container">


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

              // var flickerAPI = "https://api.flickr.com/services/feeds/photos_public.gne?format=json&tags=" + $("#searchParameter").val();format=json&nojsoncallback=1
              var flickerAPI = "https://api.flickr.com/services/rest/?api_key=9ba520fd0687a94ce0684343f3def081&method=flickr.photos.search&tags=" + $("#searchParameter").val();

              // $.ajax({
              //   url: flickerAPI,
              //   //method: 'GET',
              //   // dataType: "jsonp", // jsonp
              //   // jsonpCallback: 'jsonFlickrFeed', // add this property
              //   success: function (result, status, xhr) {
              //   $.each(result.items, function (i, item) {
              //   $("<img>").attr("src", item.media.m).appendTo("#testResultArea");
              //   // if (i === 5) {
              //   // return false;
              //   // }
              //   });
              //   error: function (xhr, status, error) {
              //   console.log(xhr)
              //   $("#testResultArea").html("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText)
              //   }
              // });


              $.ajax({
                url: flickerAPI,
                method: 'GET',
                // dataType: "jsonp",
                // jsonpCallback: 'jsonFlickrFeed',
                success: function (result) {
                  $("#testResultArea").html('');
                $.each(result['items'], function (index, value) {
                $("<img>").attr("src", value.photo.m).appendTo("#testResultArea");
                });
                }});



               //console.log("https://api.flickr.com/services/rest/?api_key=5a9ff9afbf3deba6741621c4f543dee5&method=flickr.photos.search&format=json&nojsoncallback=1&text=" + $("#searchParameter").val());
          //      $.ajax({
          //         url: "https://api.flickr.com/services/rest/?api_key=5a9ff9afbf3deba6741621c4f543dee5&method=flickr.photos.search&format=json&nojsoncallback=1&text=" + $("#searchParameter").val(),
          //         method: 'GET',
          //         data: {
          //
          //         },
          //         success: function(result){
          //
          //         	// console.log(result['items']['snippet']);
          //         		$("#testResultArea").html('');
					//     $.each(result['items'], function (index, value) {
					//     	console.log(("https://www.flicker.com/photos/flickr/" +value['id']['videoId']));
					//         $("#testResultArea").append (
					//         	// "<input type='hidden' name='url' value='" + ("https://www.youtube.com/watch?v=" + value['id']['videoId']) + "'>" +
					//         	"<a href='youtube/show/" + value['id']['videoId'] + "'>" +
					// 		 "  <img src="+ value['snippet']['thumbnails']['default']['url']+" class='img-fluid'>" +
					// 		 "<h3> " + value['snippet']['title'] + "</h3>" +
					// 		 "<h5> Channel: " + value['snippet']['channelTitle'] + "</h5>" + "</a>" +
					// 		"<hr>");
					// });
          //         }});

        });
        });
</script>

@endsection
