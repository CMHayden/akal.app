<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;



class PatientDetailsController extends Controller
{
    public function index()
    {
        $patientEmail = Auth::user()->patientEmail;
        $patient = User::where('email', "$patientEmail")->get();

        return json_encode($patientName);
    }
}
