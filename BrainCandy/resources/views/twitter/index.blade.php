@extends('layouts.app')

@section('content')

<html>

<head>
	<title>Twitter API search</title>
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

		<div id="testResultArea" class="container">


		</div>

</body>

</html>



<script>
         $(document).ready(function(){
         	$("#search").click(function(){
            //console.log("{{url('/api/twitter')}}" + "/" +$("#searchParameter").val());
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                  }
              }); // {{ url('twitter')}} + "/" +
               $.ajax({
                  url: "{{ url('/api/twitter')}}" + "/" +$("#searchParameter").val(),
                  method: 'GET',
                  data: {

                  },
                  success: function(result){
                    console.log(result);

                  }});
           });
        });
</script>

@endsection
