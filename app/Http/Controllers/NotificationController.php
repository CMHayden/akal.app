<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Mail;


class NotificationController extends Controller
{
    public function sendSMS()
    {
        $this->sendTextMessage("Message", "+000000000000"); // Get number for notification
    }

    private function sendTextMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
    }

    public function sendEmail()
    {
        try
        {        
            $data = array('name'=>'John Doe', 'email'=>'johnDoe@gmail.com'); // Get user details

            Mail::send('emails.welcome', $data, function($message) use ($data)
            {
                $message->to($data['email'], $data['name'])
                        ->subject('Welcome');
            });
        }
        catch (Exception $e)
        {
            throw new Exception($e);
        }
    }
}
