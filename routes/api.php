<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\ApiAuthController;
use App\Http\Controllers\Api\Stations\ApiStationsController;
use App\Http\Controllers\Api\Sensors\ApiSensorsController;
use App\Http\Controllers\Api\Firebase\ApiFirebaseController;
use App\Http\Controllers\Api\Alerts\ApiAlertsController;

use App\Http\Controllers\Api\Notifications\ApiNotificationsController;

use App\Mail\HighTemperatureNotification;
use App\Mail\HighHumidityNotification;
use App\Mail\LowLuminosityNotification;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    
    return $request->user();
});

Route::post('login', [ApiAuthController::class, 'login']);
Route::post('logout', [ApiAuthController::class, 'logout']);

//Stations
Route::get('stationsByUserId',[ApiStationsController::class,'stationsByUserId']);

//Sensors
Route::get('sensorsByStation',[ApiSensorsController::class, 'sensorsByStation']);
Route::get('sensorById',[ApiSensorsController::class,'sensorById']);



//Firebase

Route::get('getYears',[ApiFirebaseController::class, 'getYears']);
Route::get('todaysData',[ApiFireBaseController::class, 'todaysData']);
Route::get('dataByDate',[ApiFireBaseController::class, 'dataByDate']);

//Alerts
Route::get('getAlerts', [ApiAlertsController::class, 'getAlerts']);
Route::post('createAlert', [ApiAlertsController::class, 'createAlert']);
Route::delete('deleteAlert', [ApiAlertsController::class, 'deleteAlert']);

Route::post('sendHighTempNotif', [ApiNotificationsController::class, 'highTemperatureNotification']);
Route::post('sendHighHumiNotif', [ApiNotificationsController::class, 'highHumidityNotification']);
Route::post('sendLowLumNotif', [ApiNotificationsController::class, 'lowLuminosityNotification']);


