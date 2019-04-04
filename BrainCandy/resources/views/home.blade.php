@extends('layouts.app')

@section('content')
@if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    

                    You are logged in!
                </div>
            </div>
        </div>
    </div>

    <div class="links">
        <a href="/users/edit/{{Auth()->User()->id}}">My Flavor Profile</a>
    </div>

</div>




@endsection
