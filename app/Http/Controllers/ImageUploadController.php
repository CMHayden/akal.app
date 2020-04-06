<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use App\HTTP\Resources\ImagesResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Images;


class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showImage($fileName)
    {
        $path = public_path("/uploadedImages/{$fileName}");

        if (!\File::exists($path)) {
            return response()->json(['message' => 'Image not found.'], 404);
        }

        $file = \File::get($path);
        $type = \File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function getImage()
    {
        if(Auth::user()->userType == "patient"){
            $email = Auth::user()->email;
            $image = Images::where('patientEmail', "$email")->get()->last();

            $path = $image->filename;
            $name = $image->imageName;
        }
        return response()->json([
            'data' => ['name' => $name, 'path' => $path],
            'message' => 'got image successfully',
            'status' => 200
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store()
    {
        if (Auth::check())
        {
            $patientEmail = auth::user()->patientEmail;

            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $name = request()->name;
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('uploadedImages'), $imageName);

            Images::create([
                'filename'=>"$imageName",
                'patientEmail' => $patientEmail,
                'imageName' => $name
            ]);

            return back()
                ->with('status', "Successfully uploaded image!");
        }

        return "Oops";
    }
}