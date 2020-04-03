<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class WeatherController extends Controller
{
    public function index($lat, $long) {
        $client = new \GuzzleHttp\Client();
        $request = $client->get("https://weather.ls.hereapi.com/weather/1.0/report.json?product=observation&latitude=$lat&longitude=$long&oneobservation=true&apiKey=VCmEZ0kuIfrLP-8jdwh8lV5VTStkd8LQR4OXqnWkPsc");
        $response = $request->getBody()->getContents();
        
        return $response;
    }
}
