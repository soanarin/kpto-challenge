<?php

use App\Http\Controllers\KryptoController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

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
    return view('layouts.vue');
});
Route::get('/getalerts', [KryptoController::class, 'getAlerts']);
Route::post('/postalerts', [KryptoController::class, 'postAlerts']);
Route::post('/postOriginalTrips', [TripController::class, 'postOriginalTrips']);

