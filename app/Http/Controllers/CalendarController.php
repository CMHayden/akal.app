<?php

namespace App\Http\Controllers;

use App\Calendar;
use Illuminate\Http\Request;
use App\HTTP\Resources\CalendarResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patientEmail = auth::user()->patientEmail;

        return CalendarResource::collection(Calendar::where('patient_email',"$patientEmail")->get());
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
        $patientEmail = auth::user()->patientEmail;

        $new_calendar = Calendar::create(array_merge($request->all(), ['patient_email'=>"$patientEmail"]));
        return response()->json([
            'data' => new CalendarResource($new_calendar),
            'message' => 'New event added',
            'status' => Response::HTTP_CREATED
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar $calendar)
    {
        return response($calendar, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar $calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendar $calendar)
    {
        $patientEmail = auth::user()->patientEmail;

        $calendar->update(array_merge($request->all(), ['patient_email'=>"$patientEmail"]));
        return response()->json([
            'data' => new CalendarResource($calendar),
            'message' => 'Event updated',
            'status' => Response::HTTP_ACCEPTED
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar)
    {
        $calendar->delete();
        return response('Event removed.', Response::HTTP_NO_CONTENT);
    }
}
