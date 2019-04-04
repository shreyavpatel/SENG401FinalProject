@extends('layouts.app')
<style>
          /*  html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }*/ 
            /*makes no difference is overriden by extends*/

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }


            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            /* .centerBlock {
            display: table;
            margin: auto;
            } */

            .centerBlock > a {
                display: table;
                margin: auto;
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }


            .link_logo {
                height: 85px;
                width: 95px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
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
                    <div class="links col-md-4" >
                        <div class="centerBlock">
                            <img class="link_logo" src="lolipop.png"> 
                            <br>
                            <a href="/users/edit/{{Auth()->User()->id}}">My Flavor Profile</a>
                        </div>
                    </div>

                    <div class="links col-md-4">
                        <div class="centerBlock">
                            <img class="link_logo" src="mouth.png"> 
                            <br>    
                            <a href="/feed"> Feed </a>
                        </div>
                    </div>

                    <div class="links col-md-4">
                        <div class="centerBlock">

                            <img class="link_logo" src="jawbreaker.png"> 
                            <br>
                            <a href="#" > Jaw Droppers </a>
                        </div>

                    </div>
            </div>
    </div>


</div>




@endsection
