@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/rigs.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid my-4">
        <div class="row justify-content-center justify-content-md-between pl-4 pr-4 pl-md-3 pr-md-3">
            <h1 class="col-12 col-md-5">Browse rigs: {{$filter}}</h1>
            <div class="row pr-1 dropdown-master">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort by:
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <form action="{{route('rigs.filtered')}}" method="post">
                            @csrf
                            <input class="dropdown-item" type="submit" name="sortFilter" value="Name A-Z">
                            <input class="dropdown-item" type="submit" name="sortFilter" value="Name Z-A">
                            <input class="dropdown-item" type="submit" name="sortFilter" value="Cheapest First">
                            <input class="dropdown-item" type="submit" name="sortFilter" value="Most Expensive First">
                            <input class="dropdown-item" type="submit" name="sortFilter" value="Latest Configurations">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-start p-3">
            @for ($i = 0; $i < count($rigs); $i++)
                <div class=" p-2 pb-4 col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                    <div class="card">
                        <img src="{{$rigs[$i]->image}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$rigs[$i]->rigname}}</h5>
                            <p class="card-text"> Rig Price: {{$rigs[$i]->price}} EUR</p>
                            <a href="{{route('rigs.show',[$rigs[$i]->id])}}" class="btn btn-primary align-self-end">Check
                                Rig</a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection
