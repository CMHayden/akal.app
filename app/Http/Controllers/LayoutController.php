<?php

namespace App\Http\Controllers;

use App\layout;
use Illuminate\Http\Request;
use App\HTTP\Resources\LayoutResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LayoutController extends Controller
{
    public function updateLayouts(Request $request)
    {
        $patientEmail = auth::user()->patientEmail;

        layout::where('email',"$patientEmail")->update(array(
            'layout' => $request->input('layoutChoice')
        ));

        return back()
            ->with('layoutStatus', "Successfully updated patients layout!");
    }
}
