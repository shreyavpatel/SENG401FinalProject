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

<!-- Add this to reneder tweets -->
<script>window.twttr = (function(d, s, id) {
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
}(document, "script", "twitter-wjs"));</script>

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
              }); // {{ url('twitter')}} + "/" +
               $.ajax({
                  //url: "{{ url('/api/twitter/')}}" + "/50/" +$("#searchParameter").val(),
                  url: "{{ url('/api/twitter/id/')}}" + "/50/" +$("#searchParameter").val(),
                  method: 'GET',
                  data: {

                  },
                  success: function(result){
                    console.log(result);
                    $("#testResultArea").empty();
                    $.each(result, function (index, value){
                      $("#testResultArea").append ("<div id="+value+"></div>");

                      // for rendering tweets
                      twttr.widgets.createTweet(
                         value,
                        document.getElementById(value),
                        {
                          theme: 'light'
                        }
                      ).then( function( el ) {
                        console.log(value);
                      });

                      twttr.widgets.load(
                        document.getElementById(value)
                      );

                    });
                    // console.log(JSON.parse(result).statuses);
                    // $("#testResultArea").empty();
                    // $.each(JSON.parse(result).statuses, function (index, value){
                    //   $("#testResultArea").append ("<div id="+value['id']+"></div>");
                    //
                    //   // for rendering tweets
                    //   twttr.widgets.createTweet(
                    //      value['id_str'],
                    //     document.getElementById(value['id']),
                    //     {
                    //       theme: 'light'
                    //     }
                    //   ).then( function( el ) {
                    //     console.log(value['id_str']);
                    //   });
                    //
                    //   twttr.widgets.load(
                    //     document.getElementById(value['id'])
                    //   );
                    //
                    // });
              }});
           });
        });
</script>

@endsection
