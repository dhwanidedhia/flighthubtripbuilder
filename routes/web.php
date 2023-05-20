<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TripController;

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FlightController;
use App\Models\Airline;

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
	$airlines = Airline::get()->toArray();
    return view('trips.search',['airlines'=>$airlines]);
});

Route::resource('airlines', AirlineController::class);
Route::resource('airports', AirportController::class);
Route::resource('flights', FlightController::class);