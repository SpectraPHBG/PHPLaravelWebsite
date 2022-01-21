@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/account-page.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/scripts.js')}}"></script>
@endsection
@section('content')
    <div class="account-stuff-main">
        <div class="account-stuff">
            <div class="pfp-container">
                <img src="{{asset('img/pfp.jpeg')}}" alt="your-pfp">
            </div>
            <div class="details-flex">
                {{--Username stuff--}}
                <label class="username-label" for="username">Username:</label>
                <form style="display:none" id="username-form" action="{{route('account.changeInDetails')}}"
                      method="POST"
                      class="input-and-button-container">
                    @csrf
                    <input class="username-input" type="text" id="username" name="username" value="{{$user->name}}">
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>

                <div id="username-div" class="input-and-button-container">
                    <input class="username-input" type="text" value="{{$user->name}}" readonly="readonly">
                    <a class="btn btn-primary" type="submit" onclick="switchToSaveUsername()">Edit</a>
                </div>
                {{--End Username stuff--}}
                {{--Email stuff--}}
                <label class="email-label" for="email">Email:</label>
                <form style="display:none" id="email-form" action="{{route('account.changeInDetails')}}" method="POST"
                      class="input-and-button-container">
                    @csrf
                    <input class="email-input" type="text" id="email" name="email" value="{{$user->email}}">
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
                <div id="email-div" class="input-and-button-container">
                    <input class="email-input" type="text" value="{{$user->email}}" readonly="readonly">
                    <a class="btn btn-primary" type="submit" onclick="switchToSaveEmail()">Edit</a>
                </div>

                {{--End Email stuff--}}
                {{--Password stuff--}}
                <label class="password-label" >Password:</label>

                <a class="btn btn-primary change-password-button" onclick="switchToPasswordForm()">Change
                    password
                </a>

                {{--End Password stuff--}}
            </div>
            <form style="display:none;"  id="password-form"
                  action="{{route('account.changeInDetails')}}" method="POST"
                  class="password-flex">
                @csrf
                <label class="password-label" >Password:</label>
                <input type="password" class="password-input" name="oldPassword" id="oldPassword"
                       placeholder="Old password..." required>
                <input type="password" class="password-input new-password-input" name="newPassword" id="newPassword"
                       placeholder="New password..." required>
                <input type="password" class="password-input new-password-input" name="confirmPass" id="confirmPass"
                       placeholder="Confirm password..." required>

                <div class="details-password-switchers-holder">
                    <a class="btn btn-primary switch-to-details-button" onclick="switchToUsernameEmailForm()">Go back</a>
                    <button class="btn btn-primary change-password-button-real" type="submit">Done</button>
                </div>

            </form>

        </div>
        <div class="account-rigs">
            <div class="account-rigs-dropdown-toggler">
                <h2 class="account-rigs-toggler-text">My Computer Rigs:</h2>
                <button class="account-rigs-dropdown-button" type="button" name="button" onclick="extendRigs()">
                    <img class="account-rigs-dropdown-button-image" src="{{asset('img/dropdown-down.png')}}"
                         alt="extend..">
                </button>
            </div>
            <div class="account-rigs-dropdown-holder">
                @foreach($rigs as $rig)
                    <div class="account-rig">
                        <div class="account-rig-icon-name-container">
                            <img class="account-rig-icon" src="{{$rig->image}}" alt="">
                            <h3 class="account-rig-name">{{$rig->rigname}}</h3>
                        </div>
                        <div class="account-rig-buttons-container">
                            <form action="{{route('rigs.delete')}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="deletedRig" value="{{$rig->id}}"
                                        class="account-rig-delete-button btn">Delete
                                </button>
                            </form>
                            <form action="{{route('rigs.edit',['id'=>$rig->id])}}" method="GET">
                                @csrf
                                <button type="submit"
                                        class="account-rig-edit-button btn">
                                    Edit
                                </button>
                            </form>
                            <a class="account-rig-view-button btn" href="{{route('rigs.show',[$rig->id])}}">View</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="create-rig-container">

            <a class="btn btn-primary create-rig-button" href="{{route('rigs.create')}}">Create rig</a>
        </div>


    </div>
@endsection
