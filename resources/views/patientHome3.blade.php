@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <patient-calendar-component></patient-calendar-component>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <weather-component></weather-component>
            <br>
            <image-component></image-component>
        </div>
    </div>
</div>
@endsection
