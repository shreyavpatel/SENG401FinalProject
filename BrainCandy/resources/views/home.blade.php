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

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
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

                <div class="links">
                    <a href="/users/edit/{{Auth()->User()->id}}">Edit Your Flavor Profile</a>
                    <a href="#"> Feed </a>
                    <a href="#"> Jaw Breakers </a>
                </div>
            </div>
    </div>


</div>




@endsection
