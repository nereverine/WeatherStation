<?php

use Illuminate\Support\Facades\Route;

use App\Mail\HighTemperatureNotification;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/send-mail', function () {

    Mail::to('lucas_stormborn@hotmail.com')->send(new HighTemperatureNotification());

    return 'A message has been sent to Mailtrap!';

});