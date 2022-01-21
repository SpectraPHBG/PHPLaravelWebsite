@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/create-rig.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="account-stuff-main">
        <form action="{{route('rigs.update')}}" method="POST">
            @csrf
            <div class="rig-parts-container">
                <h1 class="customize-rig-header">Edit Configuration</h1>
                <h4 class="error-message">
                    {{$error}}
                    @if(session()->has('alert'))
                        {{ session()->get('alert') }}
                    @endif
                </h4>
                {{--Rig Name--}}
                <label for="rigName" class="part-label">Rig Name:</label>
                <input type="text" class="input-box" name="rigName" id="rigName" placeholder="Insert Rig Name"
                       value="{{$rig->name}}" required>
                {{--Price--}}
                <label for="price" class="part-label">Price [EUR]:</label>
                <input type="number" class="input-box" name="price" id="price" placeholder="Price"
                       value="{{$rig->price}}" required>
                {{--CPU--}}
                <label for="cpu" class="part-label">CPU:</label>
                <select class="combo" name="cpu" id="cpu" required>
                    <option selected value="{{$rig_cpu->id}}">{{$rig_cpu->model}}</option>
                    @foreach($cpus as $cpu)
                        <option value="{{$cpu->id}}">{{$cpu->model}}</option>
                    @endforeach
                </select>
                {{--GPU--}}
                <label for="gpu" class="part-label">GPU:</label>
                <select class="combo" name="gpu" id="gpu" required>
                    <option selected value="{{$rig_gpu->id}}">{{$rig_gpu->model}}</option>
                    @foreach($gpus as $gpu)
                        <option value="{{$gpu->id}}">{{$gpu->model}}</option>
                    @endforeach
                </select>
                {{--GPU2--}}
                <label for="gpu2" class="part-label">GPU 2 (Optional):</label>
                <select class="combo" name="gpu2" id="gpu" 2>
                    @if(is_null($rig_gpu2))
                        <option selected value="">Select....</option>
                    @else
                        <option selected value="{{$rig_gpu2->id}}">{{$rig_gpu2->model}}</option>
                        <option value="">Select....</option>
                    @endif
                    @foreach($gpus as $gpu)
                        <option value="{{$gpu->id}}">{{$gpu->model}}</option>
                    @endforeach
                </select>
                {{--Motherboard--}}
                <label for="motherboard" class="part-label">Motherboard:</label>
                <select class="combo" name="motherboard" id="motherboard" required>
                    <option selected value="{{$rig_motherboard->id}}">{{$rig_motherboard->model}}</option>
                    @foreach($motherboards as $motherboard)
                        <option value="{{$motherboard->id}}">{{$motherboard->model}}</option>
                    @endforeach
                </select>
                {{--Drive--}}
                <label for="drive" class="part-label">Drive:</label>
                <select class="combo" name="drive" id="drive" required>
                    <option selected value="{{$rig_drive->id}}">{{$rig_drive->model}}</option>
                    @foreach($drives as $drive)
                        <option value="{{$drive->id}}">{{$drive->model}}</option>
                    @endforeach
                </select>
                {{--Drive2--}}
                <label for="drive2" class="part-label">Drive 2 (Optional):</label>
                <select class="combo" name="drive2" id="drive2">
                    @if(is_null($rig_drive2))
                        <option selected value="">Select....</option>
                    @else
                        <option selected value="{{$rig_drive2->id}}">{{$rig_drive2->model}}</option>
                        <option value="">Select....</option>
                    @endif
                    @foreach($drives as $drive)
                        <option value="{{$drive->id}}">{{$drive->model}}</option>
                    @endforeach
                </select>
                {{--Cooler--}}
                <label for="cooler" class="part-label">Cooler:</label>
                <select class="combo" name="cooler" id="cooler" required>
                    <option selected value="{{$rig_cooler->id}}">{{$rig_cooler->model}}</option>
                    @foreach($coolers as $cooler)
                        <option value="{{$cooler->id}}">{{$cooler->model}}</option>
                    @endforeach
                </select>
                {{--RAM--}}
                <label for="ram" class="part-label">RAM:</label>
                <select class="combo" name="ram" id="ram" required>
                    <option selected value="{{$rig_ram->id}}">{{$rig_ram->model}}</option>
                    @foreach($rams as $ram)
                        <option value="{{$ram->id}}">{{$ram->model}}</option>
                    @endforeach
                </select>
                {{--PSU--}}
                <label for="psu" class="part-label">PSU:</label>
                <select class="combo" name="psu" id="psu" required>
                    <option selected value="{{$rig_psu->id}}">{{$rig_psu->model}}</option>
                    @foreach($psus as $psu)
                        <option value="{{$psu->id}}">{{$psu->model}}</option>
                    @endforeach
                </select>
                {{--Case--}}
                <label for="case" class="part-label">Case:</label>
                <select class="combo" name="case" id="case" required>
                    <option selected value="{{$rig_case->id}}">{{$rig_case->model}}</option>
                    @foreach($cases as $case)
                        <option value="{{$case->id}}">{{$case->model}}</option>
                    @endforeach
                </select>
                {{--Description--}}
                <label for="description" class="part-label">Description:</label>
                <textarea type="text" class="description-box" name="description" id="description"
                          placeholder="Additional Information for Rig (Optional)">@if(!is_null($rig->description)){{$rig->description}}@endif</textarea>
            </div>
            <div class="save-cancel-buttons-container">
                <div class="save-cancel-buttons-sub-container">
                    <a class="rig-cancel-button" href="{{route('home.index')}}">Cancel</a>
                    <button type="submit" class="rig-save-button" name="id" value="{{$rig->id}}">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
