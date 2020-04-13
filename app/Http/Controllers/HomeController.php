<?php

namespace App\Http\Controllers;

use App\HTTP\Resources\LayoutResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\layout;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check())
        {
            $userType = Auth::user()->userType;

            if($userType == "carer")
            {
                return view('carerHome');
            }

            if($userType == "patient")
            {
                $email = Auth::user()->email;
                $layout = LayoutResource::collection(layout::where('email',"$email")->get());

                if($layout[0]->layout == "1")
                {
                    return view('patientHome');
                }

                if($layout[0]->layout == "2")
                {
                    return view('patientHome2');
                }

                if($layout[0]->layout == "3")
                {
                    return view('patientHome3');
                }
            }

            
        }
    }
}
