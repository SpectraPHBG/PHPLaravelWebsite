@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/index-style.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="greeter container-fluid">
        <div class="row align-items-center justify-content-around ">
            <div class="greeter-left col-11 col-lg-6 p-3">
                <div class="greeter-info">
                    <h1 class="">Welcome to RigMaster!</h1>
                    <h4>Welcome to our website you frig-in awesome person. Here you can build yourself a rig like no
                        other or browse some of our already made PC. Trust us, we are totally not a scam website! </h4>
                </div>
                <div class="greeter-buttons">
                    <a class="btn btn-primary" href="{{route('rigs.create')}}">Build a Rig</a>
                    <a class="btn" href="{{route('rigs.index')}}">Browse Rigs</a>
                </div>
            </div>
            <div class="greeter-right col-lg-4 col-xl-3 p-lg-5 d-none d-lg-flex">
                <img class="img-fluid" src="{{asset('img/case1.png')}}" alt="This Should be an Image">
            </div>
        </div>
    </div>
    <div class="rated-rigs container-fluid my-5">
                <h1>Latest Rigs:</h1>

        <div class="row align-items-center">
                @for ($i = 0; $i < 8; $i++)
                    <div class=" p-2 pb-4 ccol-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card">
                                <img src="{{$rigs[$i]->image}}" class="card-img-top" alt="...">

                            <div class="card-body">
                                <h5 class="card-title">{{$rigs[$i]->rigname}}</h5>
                                <p class="card-text"> Rig Price: {{$rigs[$i]->price}} EUR</p>
                                <a href="{{route('rigs.show',[$rigs[$i]->id])}}" class="btn btn-primary">Check Rig</a>
                            </div>
                        </div>
                    </div>
                @endfor
        </div>
    </div>
@endsection
