@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    

                    You are logged in!
                </div>
            </div>
        </div>
    </div> -->


    <div class="flex-center position-ref ">
            <div class="content">
                <div class="title m-b-md">
                    <img src="logogrey.png">
                </div>

                <div class='row'>
                    <div class="links col-md-3" >
                        <div class="centerBlock"></div>
                    </div>

                    <div class="links col-md-2" >
                        <div class="centerBlock">
                            <a href="/users/edit/{{Auth()->User()->id}}">
                                <img class="link_logo" src="lolipop.png"> 
                                <br>
                                Flavor Profile
                            </a>
                        </div>
                    </div>

                    <div class="links col-md-2">
                        <div class="centerBlock">
                            <a href="/feed"> 
                                <img class="link_logo" src="mouth.png"> 
                                <br>    
                                Feed 
                            </a>
                        </div>
                    </div>

                    <div class="links col-md-2">
                        <div class="centerBlock">
                            <a href="/likes">
                                <img class="link_logo" src="jawbreaker.png"> 
                                <br>
                                Jaw Droppers 
                            </a>
                        </div>

                    </div>
                    <div class="links col-md-3" >
                        <div class="centerBlock"></div>
                    </div>
            </div>
    </div>


</div>




@endsection
