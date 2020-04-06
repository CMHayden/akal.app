@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Patient Details') }}</div>

                <div class="card-body">
                    <h4>Change Patient's Picture</h4>
                    <br>
                
                    <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="image">Select new image</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        <div class="form-group">
                            <label for="name">Descriptive text</label>
                            <input type="text" name="name" class="form-control" aria-describedby="nameHelp" placeholder="Enter descriptive text">
                            <small id="nameHelp" class="form-text text-muted">We recommend a name and the relationship the person has to the patient.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>

                    <br><br>

                    <h4>Change Patient's Temperatures</h4>
                    <br>

                    <form action="{{ route('updateTemperature') }}" method="POST" enctype="multipart/form-data">
                        @if(session('tempStatus'))
                            <div class="alert alert-success" role="alert">
                                {{ session('tempStatus') }}
                            </div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="maxTemp">Maximum temperature</label>
                            <input type="text" name="maxTemp" class="form-control" aria-describedby="maxTempHelp" placeholder="Enter maximum temperature">
                            <small id="maxTempHelp" class="form-text text-muted">We recommend a temperature of no more than 28 C.</small>
                        </div>
                        <div class="form-group">
                            <label for="name">Minimum temperature</label>
                            <input type="text" name="minTemp" class="form-control" aria-describedby="minTempHelp" placeholder="Enter minimum temperature">
                            <small id="minTempHelp" class="form-text text-muted">We recommend a temperature of no less than 15 C.</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
