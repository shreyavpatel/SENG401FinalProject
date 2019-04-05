@extends('layouts.app')

<head>
                   
<!-- https://itsolutionstuff.com/post/simple-tags-system-example-in-laravel-5example.html -->
<!-- composer require composer require rtconner/laravel-tagging -->
 <!-- TODO this stylesheet is needed for tags, but messes with the nav bar and makes font smaller and stuff -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

</head>
@section('content')



<div class="container" style="width: 55%">


    <div class='row'>
        <div class="col-md-2" >
            <img class="link_logo" src="{{ asset('lolipop.png') }}">
        </div>
        <div class="col-md-7" style='text-align:center'>
            <h2>{{$user->name}}</h2>
            <h1>Edit Your Flavor Profile</h1>
        </div>     
        <div class="col-md-2" >
            <img class="link_logo" src="{{ asset('lolipop.png') }}">
        </div> 
    </div>

    <hr>

    {!! Form::model($user, ['method'=>'PATCH', 'action'=>['UserController@update',$user->id]]) !!}

    <div class="form-group">
    	{!! Form::label('name', 'Name:') !!}
    	{!! Form::text('name', $user->name, ['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
    	{!! Form::label('email', 'Email:') !!}
    	{!! Form::text('email', $user->email, ['class'=>'form-control']) !!}
	</div>

    
    <hr>

    <!-- <div class="form-group"> -->
        <!-- {!! Form::label('interests', 'Tastes:') !!} -->
        <!-- null to $currentInterests -->
        <!-- {!! Form::text('interests', null, ['class'=>'form-control', 'placeholder' => 'seperate by a comma and a space (eg. Art, Hockey)']) !!} -->
     <!-- </div> -->



                <div class='form-group'>
                    <label>Tastes:</label>
                    <br/>
                    <input data-role='tagsinput' type='text' id='tastes' name='tastes'>
                    <!-- puts elements that look like this: -->
                    <!-- <span class="tag label label-info">taste_value<span data-role="remove"></span></span> -->

                </div>		

                @foreach($currentInterests as $i)
                <script> 
                    $( document ).ready(function() {
                        $('#tastes').tagsinput('add','{{$i}}' );
                    });
                </script>
                @endforeach


                
	<div class="form-group" style="width: 20%; margin: auto">
    	{!! Form::submit('Update', ['class'=>'btn btn-primary form-control']) !!}
	</div>

    {!! Form::close() !!}

 </div>   

    @include ('errors.list')



@stop
