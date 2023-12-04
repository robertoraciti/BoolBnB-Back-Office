<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\ServiceController;

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
Route::post('/get-apartments-by-filters', [ApartmentController::class, 'apartmentsByFilters']);

// Rotta per ricerca HOMEPAGE
Route::get('/search/{lat}/{lon}/{radius}', [ApartmentController::class, 'homepageSearch']);

// Rotta per ricerca avanzata
Route::get('/search/{lat}/{lon}/{radius}/{rooms}/{beds}', [ApartmentController::class, 'advancedSearch']);

// rotta per User
Route::apiResource('users', UserController::class)->only('index', 'show', );
Route::get('get-user/{id}', [UserController::class, 'getUser']);

// # SERVICE API
Route::apiResource('services', ServiceController::class)->only('index');