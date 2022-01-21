@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/create-rig.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="account-stuff-main">
        <form action="{{route('rigs.store')}}" method="POST">
            @csrf
            <div class="rig-parts-container">
                <h1 class="customize-rig-header">Create Configuration</h1>
                <h4 class="error-message">
                    {{$error}}
                </h4>
                <label for="rigName" class="part-label">Rig Name:</label>
                <input type="text" class="input-box" name="rigName" id="rigName" placeholder="Insert Rig Name" required>
                <label for="price" class="part-label">Price [EUR]:</label>
                <input type="number" class="input-box" name="price" id="price" placeholder="Price" required>
                <label for="cpu" class="part-label">CPU:</label>
                <select class="combo" name="cpu" id="cpu" required>
                    <option disabled selected value="">Select....</option>
                    @foreach($cpus as $cpu)
                        <option value="{{$cpu->id}}">{{$cpu->model}}</option>
                    @endforeach
                </select>
                <label for="gpu" class="part-label">GPU:</label>
                <select class="combo" name="gpu" id="gpu" required>
                    <option disabled selected value="">Select....</option>
                    @foreach($gpus as $gpu)
                        <option value="{{$gpu->id}}">{{$gpu->model}}</option>
                    @endforeach
                </select>
                <label for="gpu2" class="part-label">GPU 2 (Optional):</label>
                <select class="combo" name="gpu2" id="gpu" 2>
                    <option selected value="">Select....</option>
                    @foreach($gpus as $gpu)
                        <option value="{{$gpu->id}}">{{$gpu->model}}</option>
                    @endforeach
                </select>
                <label for="motherboard" class="part-label">Motherboard:</label>
                <select class="combo" name="motherboard" id="motherboard" required>
                    <option disabled selected value="">Select....</option>
                    @foreach($motherboards as $motherboard)
                        <option value="{{$motherboard->id}}">{{$motherboard->model}}</option>
                    @endforeach
                </select>
                <label for="drive" class="part-label">Drive:</label>
                <select class="combo" name="drive" id="drive" required>
                    <option disabled selected value="">Select....</option>
                    @foreach($drives as $drive)
                        <option value="{{$drive->id}}">{{$drive->model}}</option>
                    @endforeach
                </select>
                <label for="drive2" class="part-label">Drive 2 (Optional):</label>
                <select class="combo" name="drive2" id="drive2">
                    <option selected value="">Select....</option>
                    @foreach($drives as $drive)
                        <option value="{{$drive->id}}">{{$drive->model}}</option>
                    @endforeach
                </select>
                <label for="cooler" class="part-label">Cooler:</label>
                <select class="combo" name="cooler" id="cooler" required>
                    <option disabled selected value="">Select....</option>
                    @foreach($coolers as $cooler)
                        <option value="{{$cooler->id}}">{{$cooler->model}}</option>
                    @endforeach
                </select>
                <label for="ram" class="part-label">RAM:</label>
                <select class="combo" name="ram" id="ram" required>
                    <option disabled selected value="">Select....</option>
                    @foreach($rams as $ram)
                        <option value="{{$ram->id}}">{{$ram->model}}</option>
                    @endforeach
                </select>
                <label for="psu" class="part-label">PSU:</label>
                <select class="combo" name="psu" id="psu" required>
                    <option disabled selected value="">Select....</option>
                    @foreach($psus as $psu)
                        <option value="{{$psu->id}}">{{$psu->model}}</option>
                    @endforeach
                </select>
                <label for="case" class="part-label">Case:</label>
                <select class="combo" name="case" id="case" required>
                    <option disabled selected value="">Select....</option>
                    @foreach($cases as $case)
                        <option value="{{$case->id}}">{{$case->model}}</option>
                    @endforeach
                </select>
                <label for="description" class="part-label">Description:</label>
                <textarea type="text" class="description-box" name="description" id="description"
                          placeholder="Additional Information for Rig (Optional)"></textarea>
            </div>
            <div class="save-cancel-buttons-container">
                <div class="save-cancel-buttons-sub-container">
                    <a class="rig-cancel-button" href="{{route('home.index')}}">Cancel</a>
                    <button type="submit" class="rig-save-button">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
