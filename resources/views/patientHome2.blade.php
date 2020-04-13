@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <patient-calendar-component></patient-calendar-component>
        </div>
        <div class="col-md-4">
            <weather-component></weather-component>
            <br>
            <image-component></image-component>
        </div>
    </div>
</div>
@endsection
