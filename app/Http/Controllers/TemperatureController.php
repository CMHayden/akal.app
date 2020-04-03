<?php

namespace App\Http\Controllers;

use App\temperature;
use Illuminate\Http\Request;
use App\HTTP\Resources\TemperatureResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TemperatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patientEmail = auth::user()->patientEmail;

        return TemperatureResource::collection(Temperature::where('patientEmail',"$patientEmail")->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userEmail = auth::user()->email;
        $patientEmail = auth::user()->patientEmail;

        $new_temperature = Temperature::create([
            'updatedBy'    => "$userEmail",
            'patientEmail' => "$patientEmail",
            'minTemp'      => $request->getContent()->minTemp,
            'maxTemp'      => $request->getContent()->maxTemp
        ]);
        
        return response()->json([
            'data' => new TemperatureResource($new_temperature),
            'message' => 'Temperature stored',
            'status' => Response::HTTP_CREATED
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\temperature  $temperature
     * @return \Illuminate\Http\Response
     */
    public function show(temperature $temperature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\temperature  $temperature
     * @return \Illuminate\Http\Response
     */
    public function edit(temperature $temperature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateTemperatures(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\temperature  $temperature
     * @return \Illuminate\Http\Response
     */
    public function destroy(temperature $temperature)
    {
        //
    }
}
