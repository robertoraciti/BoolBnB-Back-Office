<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\MessageController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// # APARTMENT API
Route::apiResource('apartments', ApartmentController::class)->only('index', 'show');
Route::get('/get-apartments-by-filters', [ApartmentController::class, 'apartmentsByFilters']);

// Rotta per ricerca HOMEPAGE
Route::get('/search/{lat}/{lon}/{radius}', [ApartmentController::class, 'homepageSearch']);

// Rotta per ricerca avanzata
Route::post('/search/{lat}/{lon}/{radius}/{rooms}/{beds}', [ApartmentController::class, 'advancedSearch']); // in caso aggiungere services come variabile

// # SERVICE API
Route::apiResource('services', ServiceController::class)->only('index');

// # MESSAGE API
Route::post('/message', [MessageController::class, 'messageReceived']);

// APARTMENT VIEW
Route::post('/apartment/{id}', [ApartmentController::class, 'apartmentView']);