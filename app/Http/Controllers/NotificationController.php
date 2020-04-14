<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\User; 
use App\temperature;
use App\HTTP\Resources\TemperatureResource;
use App\HTTP\Resources\UserResource;



class NotificationController extends Controller
{
    public function alertTemperature($temp)
    {
        if (Auth::check())
        {
            $userType = Auth::user()->userType;

            if($userType == "carer")
            {
                return response()->json([
                    'message' => 'This route is only for patient users.',
                    'status' => 403
                ]);
            }
            
            else if($userType =="patient")
            {
                $patientEmail = auth::user()->email;

                $users = UserResource::collection(User::where('patientEmail',"$patientEmail")->get());
                
                $temperatures = TemperatureResource::collection(Temperature::where('patientEmail',"$patientEmail")->get());

                if($temperatures[0]->minTemp > $temp){
                    $message = "Hey! This is Akal here to tell you your patient's home is too cold 🥶! This could lead to pneumonia or hypothermia if not rectified soon.";
                    $subject = "Patient is too cold 🥶";

                    foreach ($users as $user)
                    {
                        $data = ['name' => $user->name, 'email' => $user->email, 'subject' => $subject];

                        $this->sendTextMessage($message, $user->phoneNumber);
                        $this->sendEmail('emails.coldAlert', $data);
                    }
                    
                } elseif($temperatures[0]->maxTemp < $temp){
                    
                    $message = "Hey! This is Akal here to tell you your patient's home is too hot 🥵! This could lead to dehydration if not rectified soon.";
                    $subject = "Patient is too hot 🥵";

                    foreach ($users as $user)
                    {
                        $data = ['name' => $user->name, 'email' => $user->email, 'subject' => $subject];

                        $this->sendTextMessage($message, $user->phoneNumber);
                        $this->sendEmail('emails.hotAlert', $data);
                    }

                } else {
                    return response()->json([
                        'message' => 'Good Temperature 😀',
                        'status'=> 200
                    ]);
                }

                return response()->json([
                    'message' => 'Alerts sent correctly!',
                    'status'=> 200
                ]);
            }
        }    

        return response()->json([
            'message' => 'Check sentry ASAP',
            'status' => 500
        ]);
    }

    public function alertOpenDoor()
    {
        $patientEmail = auth::user()->email;

        $message = "Patient's door has been openned! If this is expected then this message can be ignored";

        $users = UserResource::collection(User::where('patientEmail',"$patientEmail")->get());

        foreach ($users as $user)
        {
            $data = ['name' => $user->name, 'email' => $user->email, 'subject' => $subject];

            $this->sendTextMessage($message, $user->phoneNumber);
            $this->sendEmail('emails.doorAlert', $data);
        }
    }

    private function sendTextMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
    }

    public function sendEmail($view, $data)
    {
        try
        {        
            Mail::send($view, $data, function($message) use ($data)
            {
                $message->to($data['email'], $data['name'])
                        ->subject($data['subject']);
            });
        }
        catch (Exception $e)
        {
            throw new Exception($e);
        }
    }
}
