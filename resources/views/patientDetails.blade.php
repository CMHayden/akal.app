@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Change Patient's Picture</div>

                <div class="card-body">                
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

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">Change Patient's Temperatures</div>

                <div class="card-body">  
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
            <br>
            <div class="card">
                <div class="card-header">Change Patient's Layout</div>

                <div class="card-body">  
                <br>
                    <form action="{{ route('updateLayout') }}" method="POST" enctype="multipart/form-data">
                        @if(session('layoutStatus'))
                            <div class="alert alert-success" role="alert">
                                {{ session('layoutStatus') }}
                            </div>
                        @endif
                        @csrf
                        <p>Select the patients layout from the options below:</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="layoutChoice" id="layoutChoice1" value="1" checked>
                            <label class="form-check-label" for="layoutChoice1">
                                Layout 1 - Default layout.
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="layoutChoice" id="layoutChoice2" value="2">
                            <label class="form-check-label" for="layoutChoice2">
                                Layout 2 - Reversed layout.
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="layoutChoice" id="layoutChoice3" value="3">
                            <label class="form-check-label" for="layoutChoice3">
                                Layout 3 - stacked layout.
                            </label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
