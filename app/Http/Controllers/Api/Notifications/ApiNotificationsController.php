<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Mail\HighTemperatureNotification;
use App\Mail\HighHumidityNotification;
use App\Mail\LowLuminosityNotification;
use Illuminate\Support\Facades\Mail;

class ApiNotificationsController extends Controller

{
    public function highTemperatureNotification(){
        Mail::to('lucas_stormborn@hotmail.com')->send(new HighTemperatureNotification());

    return 'A message has been sent to Mailtrap!';
    }

    public function highHumidityNotification(){
        Mail::to('lucas_stormborn@hotmail.com')->send(new HighHumidityNotification());

    return 'A message has been sent to Mailtrap!';
    }

    public function lowLuminosityNotification(){
        Mail::to('lucas_stormborn@hotmail.com')->send(new LowLuminosityNotification());

    return 'A message has been sent to Mailtrap!';
    }
}