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

              var flickerAPI = "https://api.flickr.com/services/rest/?api_key=9ba520fd0687a94ce0684343f3def081&method=flickr.photos.search&format=json&nojsoncallback=1&tags=" + $("#searchParameter").val();


              $.ajax({
                url: flickerAPI,
                method: 'GET',
								data: {
								},

                success: function (result) {

									$("#testResultArea").html('');
	                $.each(result['photos']['photo'], function (index, value) {
										$("#testResultArea").append(
											"<img src= https://farm"+value['farm']+".staticflickr.com/"+value['server']+"/"+value['id']+"_"+value['secret']+".jpg>"+
											"<br><a href='https://farm"+value['farm']+".staticflickr.com/"+value['server']+"/"+value['id']+"_"+value['secret']+".jpg'>"+value['title']+"</a><br><br>"
										);
	                });
                }});
        	});
        });
</script>

@endsection
