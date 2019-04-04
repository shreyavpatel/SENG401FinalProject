@extends('layouts.app')

@section('content')

    <h2>{{$user->name}}</h2>
    <h1>Edit My Flavor Profile</h1>
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

    <div class="form-group">
        {!! Form::label('interests', 'Interests:') !!}
        {!! Form::text('interests', $currentInterests, ['class'=>'form-control', 'placeholder' => 'seperate by a comma and a space eg. Art, Hockey']) !!}
    </div>


	<div class="form-group">
    	{!! Form::submit('Update', ['class'=>'btn btn-primary form-control']) !!}
	</div>

    {!! Form::close() !!}

    @include ('errors.list')



@stop
