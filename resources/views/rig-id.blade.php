@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/rig-id.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="rig-container container-fluid py-5 ">
        <div class="row justify-content-center ">
            <div class="card-container align-self-center col-10 col-md-10 col-lg-10 col-xl-8">
                <div class="card">
                    <div class="card-header">{{$rig->rigname}}</div>

                    <div class="card-body">
                        <div class="row justify-content-center justify-content-lg-start">
                            <img src="{{asset($rig->image)}}" class="card-img-top" alt="...">
                            <div class="rig-content justify-content-end text-wrap">
                                <h1>Creator's name:</h1>
                                <h4><a href="#">{{$rig->username}}</a></h4>
                                <h2>Parts:</h2>
                                <a href="#">Case: </a>{{$rig->pccase}} <br>
                                <a href="#">GPU 1: </a>{{$rig->gpu1}}<br>
                                @if(!is_null($rig->gpu2))
                                    <a href="#">GPU 2: </a>{{$rig->gpu2}}<br>
                                @endif
                                <a href="#">CPU: </a>{{$rig->cpu}} <br>
                                <a href="#">CPU Cooler: </a>{{$rig->cooler}} <br>
                                <a href="#">Motherboard: </a>{{$rig->motherboard}} <br>
                                <a href="#">RAM: </a>{{$rig->ram}} <br>
                                <a href="#">Power Supply: </a>{{$rig->psu}} <br>
                                <a href="#">Drive 1: </a>{{$rig->drive1}} <br>
                                @if(!is_null($rig->drive2))
                                    <a href="#">Drive 2:</a> {{$rig->drive2}}<br>
                                @endif
                                <br>
                                <h4 class="rig-price">Price: {{$rig->price}} EUR</h4>  <br>
                            </div>
                        </div>
                    </div>
                    <div class="row p-5">
                        <div class="col-12">
                            <h1>Description:</h1>
                            {{$desc}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
