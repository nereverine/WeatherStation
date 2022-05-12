<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\ApiAuthController;
use App\Http\Controllers\Api\Stations\ApiStationsController;
use App\Http\Controllers\Api\Sensors\ApiSensorsController;
use App\Http\Controllers\Api\Firebase\ApiFirebaseController;
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